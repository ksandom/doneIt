# DoneIt

## The features you'll use most often.

Use `doneit --help=--feature` for any of the features below to find out everything about these features.

* `--tasks` Lists out the current possible tasks you can do. You can add more using `--addTask`.
* `--doing` Says what you are doing now.
* `--dbg` (or `--dayBeGone`) is the same as doing `--doing=bp`, which means "personal break". Ie not working.

* `--today` and `--yesterday` list what you have done today and yesterday, respectively.
* `--done` lists everything you have ever done. Combining this with `--refine` gives you the ability to do some really interesting analysis on where your time is going.
* `--tsDay`, `--tsWeek` are an effective way of choosing a specific set of results.
* `--amend` changes the current thing you're doing and takes the same parameters as `--doing`

## Example


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

* `--dbg` is an alias for `--dayBeGone` which is a reference to the movie "The emporer's new groove." It simply puts us into "Break (off the clock)".

Now we want to find a task we did earlier

    $ doneit --today --first
    2014-01-29--12:34:38: ==== misc, bob, Misce... I can't spell misc (work) - 1.5 minute showing how to use doneit
      1.5 minute (87 seconds)

And then resume it

    $ doneit --today --first --resume
    
      1390998878: 
        lastWho: -
        name: misc
        context: work
        description: Misce... I can't spell misc
        key: 1390998878

    $ doneit --today
    2014-01-29--12:34:38: ==== misc, bob, Misce... I can't spell misc (work) - 1.5 minute showing how to use doneit
    2014-01-29--12:36:05: ==== misc, bob, Misce... I can't spell misc (work) - 1.4 minute something else
    2014-01-29--12:37:28: ==== bp, -, Break (off the clock) (personal) - 8.4 minutes 
    2014-01-29--12:45:49: ==== misc, -, Misce... I can't spell misc (work) - 49 seconds testing
    2014-01-29--12:46:38: ==== misc, -, Misce... I can't spell misc (work) - 8 seconds testing
    2014-01-29--12:46:46: ==== bp, -, Break (off the clock) (personal) - 2.8 hours 
    2014-01-29--15:37:41: ==== misc, bob, Misce... I can't spell misc (work) - 58 seconds (In progress) showing how to use doneit
      3.1 hours (10983 seconds)

Oops! Not that one!

    $ doneit --removeLastDid
    2014-01-29--12:46:46: ==== bp, -, Break (off the clock) (personal) - 2.8 hours 
      2.8 hours (10255 seconds)
    $ doneit --today
    2014-01-29--12:34:38: ==== misc, bob, Misce... I can't spell misc (work) - 1.5 minute showing how to use doneit
    2014-01-29--12:36:05: ==== misc, bob, Misce... I can't spell misc (work) - 1.4 minute something else
    2014-01-29--12:37:28: ==== bp, -, Break (off the clock) (personal) - 8.4 minutes 
    2014-01-29--12:45:49: ==== misc, -, Misce... I can't spell misc (work) - 49 seconds testing
    2014-01-29--12:46:38: ==== misc, -, Misce... I can't spell misc (work) - 8 seconds testing
    2014-01-29--12:46:46: ==== bp, -, Break (off the clock) (personal) - 2.8 hours 
      3.1 hours (10983 seconds)

Let's get the right one

    $ doneit --today --first=2 --last
    2014-01-29--12:36:05: ==== misc, bob, Misce... I can't spell misc (work) - 1.4 minute something else
      1.4 minute (83 seconds)
    $ doneit --today --first=2 --last --resume
    
      1390998965: 
        lastWho: -
        name: misc
        context: work
        description: Misce... I can't spell misc
        key: 1390998965

