## TODO
Add testing

Tidy up code to psr-2 (need to install phpcs)

Create admin section to make adding races and competitors easier

Test installing from scratch

Remove unnecessary node modules


## Application creates three tables
**races**: This table holds the details of the races (at some point this should like to a meeting/venue table but for now it's a varchar meeting column).

To create a race go to the localhost/api/races/create which will only enter a race detail with a betting closing time of ten minutes

**competitors**: This holds the information for each competitor, just the name for now

To create a competitor go to /api/competitors/create this will create a competitor with a hard coded name (will look to add an admin section for entering these details more easily)

**race_competitor**: This links the above to tables, it also holds the competitor position, and the database shouldn't let you enter a race with the same position twice or competitor.


## Install

Install laravel via composer, download the repo from git hub, run `composer update` and `npm install`

to compile the js and css run 

`npm run prod`