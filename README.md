<div style="text-align: center">
<h1 align="center">Difference calculator</h1>
# Difference calculator

[![Actions Status](https://github.com/softslot/php-project-lvl2/workflows/hexlet-check/badge.svg)](https://github.com/softslot/php-project-lvl2/actions)
[![Linter](https://github.com/softslot/php-project-lvl2/actions/workflows/lint.yml/badge.svg)](https://github.com/softslot/php-project-lvl2/actions/workflows/lint.yml)
[![Tests](https://github.com/softslot/php-project-lvl2/actions/workflows/tests.yml/badge.svg)](https://github.com/softslot/php-project-lvl2/actions/workflows/tests.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/dfac19731929bf10b581/maintainability)](https://codeclimate.com/github/softslot/php-project-lvl2/maintainability)

</div>

<hr>

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

[![asciicast](https://asciinema.org/a/vnGWrgMeWbz1NnAex9xdzbxeV.svg)](https://asciinema.org/a/vnGWrgMeWbz1NnAex9xdzbxeV)

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

[![asciicast](https://asciinema.org/a/mj0eeZojQzdEeNEPHHj8wv1KL.svg)](https://asciinema.org/a/mj0eeZojQzdEeNEPHHj8wv1KL)

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