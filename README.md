Laravel Eloquent Filter
====

An easy way to filter Queries Laravel Eloquent.

# Install (Laravel)

```
$ composer require mohamedgaber-intake40/eloquent-filter
```

The Package is auto discovered , but you can register Service Provider in config/app.php

```php
 'providers' => [
    \Filter\Providers\FilterServiceProvider::class
];
```

# Usage

* make filter class using this command for example UserFilter

```
php artisan make:filter UserFilter
```

* this will generate UserFilter in app\Filters

_____________

* add the Filter\HasFilter trait to your model(s):

```php
  class User extends Authenticatable 
  {
        use HasFilter;
  }
```
* this will add filter scope to User model
* note : User model its filter class should be UserFilter by default , but you can override this by overriding getFilterClassName method in the model

```php
protected function getFilterClassName()
{
    return App\Filters\MyUserFilter::class;
}
```
_____________

* in App\Filters\UserFilter Class , you have to add methods to filter model properties for example :
    - if you want to filter name you have to add filter name method like this

```php
protected function filterName($name)
{
    $this->query->where('name','like',"%$name%");
}
```
* also, you can filter any relations , example : user has many posts
```php
  protected function filterPosts($posts)
  {
      $this->query->whereHas('posts',function($q) use ($posts){
        $q->whereIn('id',$posts);
      });
  }
  ```
_____________

* now you can filter your model query like this

```php
 App\Models\User::filter([ 'name' => 'test' , 'posts' => [1,2,3] ])->get();
```

# Notes
- filter method must be filter{property} example to filter name , it will be filterName
- if property is something_something , method will be filterSomethingSomething , example : filterFirstName
- when filter class has many methods like filterName, filterAge these methods will be called only when filter array has property matched with the method name



