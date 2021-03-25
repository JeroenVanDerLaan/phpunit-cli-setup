# PHPUnit CLI Setup
A PHPUnit extension for preparing test suite execution using CLI commands.

## Usage
Add the `CliSetupExtension` to your `phpunit.xml` `<extension>` configuration and have it execute CLI commands before running your test suite(s).
```xml
<phpunit>
    <extensions>
        <extension class="Jeroenvanderlaan\PhpUnitCliSetup\Extension\CliSetupExtension">
            <arguments>
                <string>bin/my-command</string>
            </arguments>
        </extension>
    </extensions>
</phpunit>
```
This will execute `bin/my-command` before running your test suite(s).

Optionally, you can limit the execution of CLI commands to specific test suites only.
```xml
<phpunit>
    <extensions>
        <extension class="Jeroenvanderlaan\PhpUnitCliSetup\Extension\CliSetupExtension">
            <arguments>
                <string>bin/my-command</string>
                <array>
                    <element key="0">
                        <string>my-test-suite</string>
                    </element>
                </array>
            </arguments>
        </extension>
    </extensions>
</phpunit>
```
This will execute `bin/my-command` only when running the test suite `my-test-suite`.
