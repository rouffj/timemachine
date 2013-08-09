PHPUNIT_BIN=phpunit
PHPUNIT_OPTS=

help:
	@echo "test        Run all tests"
	@echo "example    Allow to run examples"

howto:
	$(PHPUNIT_BIN) --testdox --testsuite TimeHowTo

test:
	$(PHPUNIT_BIN) $(PHPUNIT_OPTS)

example:
	$(PHPUNIT_BIN) --testdox examples/
