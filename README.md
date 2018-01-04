# laravel_task
Stylemix Test Task, Laravel based API for grocery list

## Steps of the DEVELOPMENT process

1. create 3 models: *ProductGroup*, *Product* (both migration- and factory-ready) and *GroceryList* (migration-, factory- and resource controller-ready)
```
php artisan make:model ProductGroup -mf
php artisan make:model Product -mf
php artisan make:model Grocerylist -crmf
```
2. populate the migration files for the corresponding files:
```php
public function up()
{
    Schema::create('product_groups', function (Blueprint $table) {
    $table->increments('id');
    $table->string('group_name');
    $table->timestamps();
    });
}
```
**database\migrations\product_group**

```php
public function up()
{
    Schema::create('products', function (Blueprint $table) {
    $table->increments('id');
    $table->string('product_name');
    $table->integer('group_id')->unsigned();
    $table->timestamps();

    $table->foreign('group_id')->references('id')->on('product_groups');
    });
}
```
**database\migrations\product**

```php
public function up()
{
    Schema::create('grocery_lists', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('product_id')->unsigned();
    $table->integer('price');
    $table->integer('quantity');
    $table->timestamps();

    $table->foreign('product_id')->references('id')->on('products');
    });
}
```
**database\migrations\grocery_list**
3. prepare the database and initiate the migration `php artisan migrate`
4. create a *GroceryList* resource `php artisan make:resource GroceryList`
5. populate *toArray()* method of the resource:
```php
public function toArray($request)
{
    return [
    'id' => $this->id,
    'product' => $this->product_id,
    'quantity' => $this->quantity,
    'price' => $this->price,
    'created_at' => (string)$this->created_at,
    'updated_at' => (string)$this->updated_at,
  ];
}
```
6. populate *show()* method of the *GroceryListController* to display a JSON:API formatted response:
```php
public function show($id)
{
    GroceryListResource::withoutWrapping();
    return new GroceryListResource(GroceryList::find($id));
}
```
7. add a new route in order to parse the address bar query in accordance with the above controller:
```php
Route::get('/grocerylist/{id}', 'GroceryListController@show');
```
8. populate the database with test information and execute `php artisan serve` to check the resulting response

Projecting on an abstract **MVC**-pattern, steps 1-3 reflect the preparation of the Model (**M**); steps 4 and 5 - the View (**V**); and the rest of the steps - the Controller (**C**).

## Steps of the TESTING process
1. create *GroceryList* table seeder and populate with:
```php
public function run()
{
    factory(App\GroceryList::class, 10)->create();
}
```
2. populate the *DatabaseSeeder.php* file with:
```php
use Illuminate\Database\Eloquent\Model;

public function run()
{
    Model::unguard();

    $this->call(GroceryListTableSeeder::class);

    Model::reguard();
}
```
3. instruct factories for *GroceryList*, *Product* and *ProductGroup* on what to insert into the table:
```php
$factory->define(App\GroceryList::class, function (Faker $faker) {
    return [
  	    'product_id' => function () {
  			    return factory(App\Product::class)->create()->id;
  		  },
        'price' => $faker->randomNumber,
  		  'quantity' => $faker->numberBetween($min = 1, $max = 1000),
    ];
});
```

```php
$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'product_name' => $faker->word,
        'group_id'=> function () {
			  return factory(App\ProductGroup::class)->create()->id;
		}
    ];
});
```

```php
$factory->define(App\ProductGroup::class, function (Faker $faker) {
    return [
        'group_name' => $faker->word,
    ];
});
```
4. execute the `php artisan migrate --seed` to fill the tables with a sample data.

### References
- [Laravel Official Documentation](https://laravel.com/docs/5.5/readme)
- [Model Factories in Laravel](https://laravel-news.com/learn-to-use-model-factories-in-laravel-5-1)
- [Creating APIs in Laravel 5.5 using API resources](https://medium.com/@devlob/creating-apis-in-laravel-5-5-using-api-resources-9850c1b70efb)
- [Using Laravel 5.5 Resources to create your own {JSON:API} formatted API](https://medium.com/@dinotedesco/using-laravel-5-5-resources-to-create-your-own-json-api-formatted-api-2c6af5e4d0e8)
- [Model–view–controller](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)
