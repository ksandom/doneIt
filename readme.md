# DoneIt

A commandline tool for tracking time based on a notation I've been using on paper for the last few years.

## Installing it

    export extraSrc="git@github.com:ksandom/doneIt.git"; curl https://raw.github.com/ksandom/achel/master/supplimentary/misc/webInstall | bash

## Using it

    $ doneit --doing=misc,bob,"showing how to use doneit"
    $ doneit --today
    2014-01-29--12:34:38: ==== misc, bob, Misce... I can't spell misc (work) - 4 seconds (In progress) showing how to use doneit
      0 seconds (0 seconds)

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

[More info](https://github.com/ksandom/doneIt/tree/master/packages-available/DoneIt/docs).
