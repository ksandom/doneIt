# DoneIt - Context

A way of attributing time to different things. Eg different companies, personal time, project time etc.

## Usage

### List out the available contexts

```
$ doneit --contexts
test  blah
personal  Personal free time.
work  Paid company time.
project  Personal project time.

Current: project
```

### Use a context for all up-coming dids

```
$ doneit --context
[debug0] Current context: project

$ doneit --context=work
[debug0] Previous context: project
work  Paid company time.

Current: work
```

### List dids that are relevant to the current context

```
$ doneit --rel
2024-09-17--16:28:21 ==== (work)  -  e (E-mail)     20.9 minutes (In progress)
  20.9 minutes (1253 seconds)

$ doneit --context=project
[debug0] Previous context: work
project  Personal project time.

Current: project

$ doneit --rel
2024-09-17--16:01:27 ==== (project)  doneIt  test (Testing)   context  26.9 minutes
  26.9 minutes (1614 seconds)
```

### Add a context

```
$ doneit --addContext=pc,"Procrastinating from the required task."
$ doneit --contexts
test  blah
personal  Personal free time.
work  Paid company time.
project  Personal project time.
pc  Procrastinating from the required task.

Current: project
```

### Delete a context

```
$ doneit --contexts=pc
pc  Procrastinating from the required task.

Current: project

$ doneit --contexts=pc --deleteContext
pc  Procrastinating from the required task.

Current: project

$ doneit --contexts=pc

Current: project
```
