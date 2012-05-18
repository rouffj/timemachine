PHPUNIT_BIN=phpunit
PHPUNIT_OPTS=

help:
	@echo "test        Run all tests"

test:
	$(PHPUNIT_BIN) $(PHPUNIT_OPTS)
