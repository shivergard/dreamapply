# Task

    1. Design any data format to configure the academic years and terms as described below.
        1.1. This can be an ini file, xml file, yaml or anything you prefer [X]
        1.2. The data format must he human-editable [X]
        1.3. The data format must allow years and terms in the future to be configured  differently without affecting any previous years. In the data, it is shown that one year the academic year started 5 days later than usual and in 2016 the school switched to the trimester system. [X]
        1.4. Design the data format to be as elegant as possible [X] 
    2. Design a sensible class structure to represent the academic years & terms and a suitable API to answer the questions in point (4) [---]
    3. Create a factory to load the data (1) and construct the objects representing the years and terms (2). [x]
    4. Implement methods to answer the following questions:
        4.1. Given a date (D), return the academic year object (AY) that this date lies on.
            4.1.1. Decide what to do when the academic year is not configured. Return false, NULL, throw an exception? [x]
         4.1.2. An academic year is considered "in effect" until the next academic year has not yet started. Make sure you get 2015-09-03 correct [x]
        4.2. Given the academic year (AY), get it's name, e.g. "2015/16" [x]
        4.3. Given the academic year (AY), return all the academic terms (AT) that belong to it. [x]
        4.4. Given the academic term (AT), print it's name, e.g "Spring 2015/16" [x]
        4.5. Given the academic term (AT), calculate it's length in calendar days. [x]
    5. Write a script to bootstrap and run the code via CLI. 
        5.1. The script should take two arguments:
            5.1.1. Location of the configuration file [X]
            5.2.2. The date (D)
        5.2. The script should print the answers to the questions in (4), for example:
> Date belongs to academic year 2015/16 
> Academic year contains the ofllowing terms:
>> Autumn 2015/16 (x days)
>> Fall 2015/16 (x days) 
6. You are expected to implement the solution in PHP. Use any external libraries you wish (composer!). [X]


Data:
```
Academic year 2014/15 (starts 1st of September 2014)
Autumn semester September 1 -> December 10
Spring semester January 4 -> April 15
Academic year 2015/16 (starts 5th of September 2015)
Autumn semester September 1 -> December 8
Spring semester January 5 -> April 17
Academic year 2016/17 (starts 1st of September 2016)
First trimester September 1 -> October 28
Second trimester November 1 -> January 20
Third trimester January 28 -> April 19
```
### Note: 
academic terms within an academci years are not supposed to overlap, so an exception should be thrown if such a condition occurs.

###References:
 
[Academic year](https://en.wikipedia.org/wiki/Academic_year)

[Academic term](https://en.wikipedia.org/wiki/Academic_term)