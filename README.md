## Installation

~~~sh
mkdir -p /path/to/project
cd /path/to/project

git clone git@github.com:inveteratus/laravel-template.git .

composer install
npm install

cp .env.example .env

vendor/bin/sail up -d

vendor/bin/sail artisan key:generate
vendor/bin/sail artisan storage:link
vendor/bin/sail artisan migrate:fresh --seed 

npm run dev
~~~

Finally, navigate to [http://localhost](http://localhost/)

## Post Installation

Add the scheduler to your crontab:

```
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

During development, you will need to use sail:

```
* * * * * cd /path/to/project && vendor/bin/sail artisan schedule:run >> /dev/null 2>&1
```

or manually call:

```
vendor/bin/sail artisan schedule:work
```
