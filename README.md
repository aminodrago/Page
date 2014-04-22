This is a Laravel 4 package that provides multilingual page interface for lavalite framework.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `lavalite/page`.

    "lavalite/page": "dev-master"

Next, update Composer from the Terminal:

    composer update

Once this operation completes, the final step is to add the service provider and menu alias. Open `app/config/app.php`, and add a new item to the providers array.

    'Lavalite\Page\PageServiceProvider'

Add the following to the alias array.

    'Page' => 'Lavalite\Page\Facades\Page',

Publishing Configuration file

    php artisan config:publish lavalite/page

publish the view for customization

    php artisan view:publish lavalite/page

The last thing to do is to migrate to create the pages table:

    php artisan migrate --package="lavalite/page"

You are done!

### Usage

Add pages through `admin/pages`

You can add this to menu in admin through [menu](https://github.com/LavaLite/Menu) Package

Browser to get page browse `/{slug}.html`

Calling other pages inside a view or function
```php
{{Page::heading('slug')}}
{{Page::content('slug')}}
{{Page::title('slug')}}
{{Page::keyword('slug')}}
{{Page::description('slug')}}
{{Page::banner('slug')}}
```

 
