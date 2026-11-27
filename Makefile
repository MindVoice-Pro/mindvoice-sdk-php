.PHONY: generate test test-http lint

generate:
	php tools/generate.php

test:
	php tests/run.php

test-http:
	sh tests/http.sh

lint:
	find src tools tests -name '*.php' -not -path 'tools/vendor/*' -print0 | xargs -0 -n 1 php -l
