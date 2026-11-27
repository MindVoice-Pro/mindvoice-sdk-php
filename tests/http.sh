#!/bin/sh

set -eu

# Поднимаем локальную фикстуру на свободном порту и завершаем её после проверки.
test_dir=$(mktemp -d)
test_server_pid=''
cleanup() {
    if [ -n "$test_server_pid" ]; then
        kill "$test_server_pid" 2>/dev/null || true
    fi
    rm -rf "$test_dir"
}
trap cleanup EXIT
trap 'exit 1' HUP INT TERM

test_port=$(php -r '
    $socket = stream_socket_server("tcp://127.0.0.1:0");
    if ($socket === false) { exit(1); }
    echo substr(strrchr(stream_socket_get_name($socket, false), ":"), 1);
')
php -d upload_max_filesize=32M -d post_max_size=40M -S "127.0.0.1:$test_port" tests/http-router.php >"$test_dir/server.log" 2>&1 &
test_server_pid=$!

# Ждём готовности сервера до выполнения HTTP-тестов.
test_ready=0
for test_attempt in 1 2 3 4 5 6 7 8 9 10; do
    if php -r 'exit(@fsockopen("127.0.0.1", (int) $argv[1]) === false ? 1 : 0);' "$test_port"; then
        test_ready=1
        break
    fi
    sleep 0.2
done
if [ "$test_ready" -ne 1 ] || ! php -d memory_limit=12M -d error_reporting=-1 tests/http-client.php "$test_port"; then
    cat "$test_dir/server.log" >&2
    exit 1
fi
