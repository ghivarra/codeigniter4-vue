# codeigniter4-vue
Library to auto-injecting Vue JS to CodeIgniter 4 application

## How to use
1. Install Vue JS 3 using [this steps](https://vuejs.org/guide/quick-start.html) **outside** your root CodeIgniter 4 installation as a separate project folder
2. Copy all files inside Vue JS installation folder except **README.md**, **.gitignore** and **public folder** as it will be conflicted with CodeIgniter 4 files and folders
3. Add new environment variable to your **.env** file, you can see it on [_.env.example_](https://github.com/ghivarra/codeigniter4-vue/blob/main/.env.example) on this repository
4. Replace file _src/main.js_ with [**main.js**](https://github.com/ghivarra/codeigniter4-vue/blob/main/main.js) file from this repository
5. Replace file _vite.config.js_ with [**vite.config.js**](https://github.com/ghivarra/codeigniter4-vue/blob/main/vite.config.js) file from this repository
6. Create your **Root View** php file in _app/Views_. You can create one for yourself or you can just copy the [**DefaultView.php**](https://github.com/ghivarra/codeigniter4-vue/blob/main/DefaultView.php) file into _app/Views_ folder
7. Put [**Vuenized.php**](https://github.com/ghivarra/codeigniter4-vue/blob/main/Vuenized.php) into folder _app/Libraries/Ghivarra_, if folder not exist, you can manually create it
8. You can access this library by placing **use App\Libraries\Ghivarra\Vuenized** on top of your CodeIgniter 4 Controller
9. Next, you use **render()** to inject vue js to your root view, don't forget to update your route configurations _app/Config/Routes.php_ file to target the request into this controller

Here is the basic example for _YourController.php_ :

```
use App\Libraries\Ghivarra\Vuenized;

class YourController extends BaseController
{
  public function index(): string
  {
    $vuenized = new Vuenized();

    // inject vue to CI App
    return $vuenized->render('App.vue');
  }
}
```
9. Run __npm run dev__ from your console to run vite development server of Vue JS 3
10. If you wanted to build you can just run **npm run build** and the library will inject the built Vue JS 3 assets into your root view

## Set Default Root View
By default we use _'app/views/DefaultView.php'_ as a root view. However, you can set it using **setRootView()** function. Here is the basic example if you wanted to change your default root view to _'app/views/MyView/VueApp.php'_ :

```
use App\Libraries\Ghivarra\Vuenized;

class YourController extends BaseController
{
  public function index(): string
  {
    $vuenized = new Vuenized();

    // set your root view here
    $vuenized->setRootView('MyView/VueApp');

    // inject vue to CI App
    return $vuenized->render('App.vue');
  }
}
```
