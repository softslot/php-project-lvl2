
<h1 align="center">Differ</h1>

<div align="center">

[![Actions Status](https://github.com/softslot/php-project-lvl2/workflows/hexlet-check/badge.svg)](https://github.com/softslot/php-project-lvl2/actions)
[![Lint and tests](https://github.com/softslot/php-project-lvl2/actions/workflows/lint_and_tests.yml/badge.svg)](https://github.com/softslot/php-project-lvl2/actions/workflows/lint_and_tests.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/dfac19731929bf10b581/maintainability)](https://codeclimate.com/github/softslot/php-project-lvl2/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/dfac19731929bf10b581/test_coverage)](https://codeclimate.com/github/softslot/php-project-lvl2/test_coverage)

</div>

<hr>

Differ - is a library that defines the difference between two data structures.

<strong>Utility Features:</strong>
<ul>
<li>Support for different input formats: yaml, json</li>
<li>Generating a report in the form of plain text, stylish and json</li>
</ul>

<hr>

### Requirements
<ul>
<li>PHP 8.0+</li>
<li>Composer 2.0</li>
</ul>

<hr>

### Setup
```sh
$ git clone https://github.com/softslot/php-project-lvl2.git

$ make install
```

<hr>

<h2 align="center">Examples</h2>

### Comparison of flat files (JSON)

<details>

<summary>file1.json </summary>

```json
{
  "host": "hexlet.io",
  "timeout": 50,
  "proxy": "123.234.53.22",
  "follow": false
}
```

</details>

<details>

<summary>file2.json </summary>

```json
{
  "timeout": 20,
  "verbose": true,
  "host": "hexlet.io"
}
```

</details>

[![asciicast](https://asciinema.org/a/j578iszWaf5k9SwOm6LMf7dXT.svg)](https://asciinema.org/a/j578iszWaf5k9SwOm6LMf7dXT)

### Comparison of flat files (YAML)

<details>

<summary>file1.yml </summary>

```yaml
host: hexlet.io
timeout: 50
proxy: 123.234.53.22
follow: false
```

</details>

<details>

<summary>file2.yml </summary>

```yaml
timeout: 20
verbose: true
host: hexlet.io
```

</details>

[![asciicast](https://asciinema.org/a/nZZI86hWQYvgTRsYKcM0xHS9H.svg)](https://asciinema.org/a/nZZI86hWQYvgTRsYKcM0xHS9H)

### Recursive comparison (Json)

<details>

<summary>file1.json </summary>

```json
{
  "common": {
    "setting1": "Value 1",
    "setting2": 200,
    "setting3": true,
    "setting6": {
      "key": "value",
      "doge": {
        "wow": ""
      }
    }
  },
  "group1": {
    "baz": "bas",
    "foo": "bar",
    "nest": {
      "key": "value"
    }
  },
  "group2": {
    "abc": 12345,
    "deep": {
      "id": 45
    }
  }
}
```

</details>

<details>

<summary>file2.json </summary>

```json
{
  "common": {
    "follow": false,
    "setting1": "Value 1",
    "setting3": null,
    "setting4": "blah blah",
    "setting5": {
      "key5": "value5"
    },
    "setting6": {
      "key": "value",
      "ops": "vops",
      "doge": {
        "wow": "so much"
      }
    }
  },
  "group1": {
    "foo": "bar",
    "baz": "bars",
    "nest": "str"
  },
  "group3": {
    "deep": {
      "id": {
        "number": 45
      }
    },
    "fee": 100500
  }
}
```

</details>

[![asciicast](https://asciinema.org/a/zLHSYAkdtLMROYF41uQ5e4Bwv.svg)](https://asciinema.org/a/zLHSYAkdtLMROYF41uQ5e4Bwv)

### Recursive comparison (Yaml)

<details>

<summary>file1.yml </summary>

```yaml
common:
  setting1: Value 1
  setting2: 200
  setting3: true
  setting6:
    key: value
    doge:
      wow: ''
group1:
  baz: bas
  foo: bar
  nest:
    key: value
group2:
  abc: 12345
  deep:
    id: 45
```

</details>

<details>

<summary>file2.yml </summary>

```yaml
common:
  follow: false
  setting1: Value 1
  setting3:
  setting4: blah blah
  setting5:
    key5: value5
  setting6:
    key: value
    ops: vops
    doge:
      wow: so much
group1:
  foo: bar
  baz: bars
  nest: str
group3:
  deep:
    id:
      number: 45
  fee: 100500
```

</details>

[![asciicast](https://asciinema.org/a/6Q7Du9SPrvhmDnVR3NKG1A1tE.svg)](https://asciinema.org/a/6Q7Du9SPrvhmDnVR3NKG1A1tE)

### Flat format

<details>

<summary>file1.json </summary>

```json
{
  "common": {
    "setting1": "Value 1",
    "setting2": 200,
    "setting3": true,
    "setting6": {
      "key": "value",
      "doge": {
        "wow": ""
      }
    }
  },
  "group1": {
    "baz": "bas",
    "foo": "bar",
    "nest": {
      "key": "value"
    }
  },
  "group2": {
    "abc": 12345,
    "deep": {
      "id": 45
    }
  }
}
```

</details>

<details>

<summary>file2.json </summary>

```json
{
  "common": {
    "follow": false,
    "setting1": "Value 1",
    "setting3": null,
    "setting4": "blah blah",
    "setting5": {
      "key5": "value5"
    },
    "setting6": {
      "key": "value",
      "ops": "vops",
      "doge": {
        "wow": "so much"
      }
    }
  },
  "group1": {
    "foo": "bar",
    "baz": "bars",
    "nest": "str"
  },
  "group3": {
    "deep": {
      "id": {
        "number": 45
      }
    },
    "fee": 100500
  }
}
```

</details>

[![asciicast](https://asciinema.org/a/9uSslWd4WQcRzMYeHVCPyHbkA.svg)](https://asciinema.org/a/9uSslWd4WQcRzMYeHVCPyHbkA)

### Json format

<details>

<summary>file1.json </summary>

```json
{
  "common": {
    "setting1": "Value 1",
    "setting2": 200,
    "setting3": true,
    "setting6": {
      "key": "value",
      "doge": {
        "wow": ""
      }
    }
  },
  "group1": {
    "baz": "bas",
    "foo": "bar",
    "nest": {
      "key": "value"
    }
  },
  "group2": {
    "abc": 12345,
    "deep": {
      "id": 45
    }
  }
}
```

</details>

<details>

<summary>file2.json </summary>

```json
{
  "common": {
    "follow": false,
    "setting1": "Value 1",
    "setting3": null,
    "setting4": "blah blah",
    "setting5": {
      "key5": "value5"
    },
    "setting6": {
      "key": "value",
      "ops": "vops",
      "doge": {
        "wow": "so much"
      }
    }
  },
  "group1": {
    "foo": "bar",
    "baz": "bars",
    "nest": "str"
  },
  "group3": {
    "deep": {
      "id": {
        "number": 45
      }
    },
    "fee": 100500
  }
}
```

</details>

[![asciicast](https://asciinema.org/a/AVpgos1lo4rJIYQW0qX8IkmgC.svg)](https://asciinema.org/a/AVpgos1lo4rJIYQW0qX8IkmgC)