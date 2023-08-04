<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## QuickStart 2022
<details><summary>For fresh newbie: Refer here</summary>
<br />
We will be using Github Dekstop as our Git tool, VSCode as our code and editor Laragon for window users:
<ol>
    <li> Install VSCode (https://code.visualstudio.com/download)</li>
    <li> Create Git Account based on your work email (https://github.com/) </li>
    <li> Install Github Desktop (https://desktop.github.com/)</li>
    <li> Setup your Github Desktop with your Git account </li>
    <li> Install Laragon (https://laragon.org/download/index.html) </li>
    <li> Add PHP 8 inside Laragon (https://www.kreaweb.be/laragon-update-php/) <pre> Recommend php-8.1.10-Win32-vs16-x64.zip</pre></li>
    <li> Add MySQL 8 inside Laragon (https://www.kreaweb.be/laragon-update-mysql/) <pre> Recommend mysql 8.0.29 and above</pre></li>
    <li> Add Node V16.7 inside Laragon (https://www.kreaweb.be/laragon-update-nodejs/) <pre> Recommend Node JS version 16.7 and above</pre></li>
    <li> In Laragon, make sure choosen version of PHP, MYSQL and Node are correct in the Menu</li>
</ol>
</details>
<details><summary>VSCode Settings</summary>
    <ol>
        <li> Install EditorConfig for VSCode inside VSCode (https://marketplace.visualstudio.com/items?itemName=EditorConfig.EditorConfig/)</li>
        <li> Inside VSCODE, CTRL + SHIFT + P, Find Preferences: Open User Settings (JSON). Add code below <pre> "editor.formatOnSave": true </pre></li>
        <li> Open terminal and run this command <pre> npm install -g editorconfig </pre></li>
        <li> By default, your root project directory should have .editorconfig file. The content should be like this <pre>root = true

[*]
charset = utf-8
end_of_line = lf
insert_final_newline = true
indent_style = space
indent_size = 4
trim_trailing_whitespace = true

[*.md]
trim_trailing_whitespace = false

[*.{yml,yaml}]
indent_size = 2</pre></li>
    </ol>
</details>


Components:

- [Laravel 10 Docs](https://laravel.com/docs/10.x/installation)
- [Vuexy Documentation](https://pixinvent.com/demo/vuexy-vuejs-admin-dashboard-template/documentation/guide/)
- [Vuexy Demo](https://pixinvent.com/demo/vuexy-vuejs-admin-dashboard-template/demo-1/login)
- [Laravel Uploaded File](https://packagist.org/packages/developer-unijaya/laravel-uploaded-file)
- [Flow Management Function](https://packagist.org/packages/developer-unijaya/flow-management-function)

System Requirement:
<ol>
    <li> PHP version: <pre>8.1.0 and above</pre></li>
    <li> Database version: <pre>MySQL 8.0.29 and above</pre></li>
</ol>
Instructions:
<ol>
    <li> Git Clone </li>
    <li> Copy file .env.example to .env <pre>cp .env.example .env</pre> </li>
    <li> Create a database in your system</li>
    <li> Configure database connection inside .env (Line 12-17)</li>
    <li> Run <pre>composer install</pre> </li>
    <li> Run <pre>php artisan key:generate</pre> </li>
    <li> Run (do not run in server) <pre>npm install</pre> </li>
    <li> Run (do not run in server) <pre>npm run prod</pre> </li>
    <li> Run <pre>php artisan storage:link</pre> </li>
    <li> Run <pre>php artisan migrate</pre> </li>
    <li> Run <pre>php artisan db:seed</pre> </li>
</ol>

Notes:
<ul>
    <li> To add Custom CSS: Go to  <i>resources\views\panels\styles.blade.php</i> </li>
    <li> To add Custom Javascript Code: Go to  <i>resources\views\panels\scripts.blade.php</i> </li>
    <li> To add JS Library from NPM Package: Refer <i>resources\js\core\custom.js</i> </li>
    <li> (Server Env): After run <pre>git pull</pre>, please run <pre>php artisan optimize && php artisan config:clear</pre> </li>
</ul>

## Encounter Error
<ol>
    <li>  bootstrap\cache directory must be present and writable. 
        <pre>Delete folder cache inside folder bootstrap and create new folder named cache</pre>
    </li>
</ol>

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

Recommended Study Reference:
<ul>
    <li> Laracasts (https://laracasts.com) - contains videos tutorials with many topics including Laravel, modern PHP, unit testing, and JavaScript. </li>
    <li> LaravelDaily (https://www.youtube.com/c/LaravelDaily) - A youtuber that teach or present latest feature of laravel.  </li>
</ul>


