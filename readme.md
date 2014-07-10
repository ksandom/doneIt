# DoneIt

A commandline tool for tracking time based on a notation I've been using on paper for the last few years.

## Installing it

    export extraSrc="https://github.com/ksandom/doneIt.git"; curl https://raw.githubusercontent.com/ksandom/achel/master/supplimentary/misc/webInstall | bash

## Using it

    $ doneit --doing=misc,bob,"showing how to use doneit"
    $ doneit --today
    2014-01-29--12:34:38: ==== misc, bob, Misce... I can't spell misc (work) - 4 seconds (In progress) showing how to use doneit
      0 seconds (0 seconds)

* `misc` is the type of task that we are doing. You can find these with `--listTasks`.
* `bob` is the person who the task is for/with. If I'm working on a ticket, I put the ticket number in here.
* `"showing how to use doneit"` is the description of the task. Note that doneIt doesn't require the quotes, but bash needs them to keep the whole sentence as one parameter since bash defaults to space separated parameters.
* `--today` shows what we have done so far.

*Some time later* we start something else

    $ doneit --doing=misc,bob,"something else"
    $ doneit --today
    2014-01-29--12:34:38: ==== misc, bob, Misce... I can't spell misc (work) - 1.5 minute showing how to use doneit
    2014-01-29--12:36:05: ==== misc, bob, Misce... I can't spell misc (work) - 6 seconds (In progress) something else
      1.5 minute (87 seconds)

*Some more time later* we sign off for the day

    $ doneit --dbg
    $ doneit --today
    2014-01-29--12:34:38: ==== misc, bob, Misce... I can't spell misc (work) - 1.5 minute showing how to use doneit
    2014-01-29--12:36:05: ==== misc, bob, Misce... I can't spell misc (work) - 1.4 minute something else
    2014-01-29--12:37:28: ==== bp, -, Break (off the clock) (personal) - 3 seconds (In progress) 
      2.8 minutes (170 seconds)

* `--dbg` is an alias for `--dayBeGone` which is a reference to the movie "[The emporer's new groove](https://www.youtube.com/watch?v=Fv-sKP17xTw&feature=youtu.be&t=1m22s)." It simply puts us into "Break (off the clock)".

There's a really good worked example [here](https://github.com/ksandom/doneIt/tree/master/packages-available/DoneIt/docs), which quickly shows you have to do some every day things and how to find out more.
