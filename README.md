## Installation

~~~
mkdir myapp
cd myapp

git clone git@github.com:inveteratus/laravel-template.git .

composer install
npm install

sail up -d

sail artisan key:generate
sail artisan storage:link
sail artisan migrate:fresh --seed 

npm run dev
~~~

Finally, navigate to [http://localhost](http://localhost/)
