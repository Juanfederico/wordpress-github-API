# wordpress-github-API
Creación de un plugin que consume la API de GitHub y filtra búsquedas según los criterios definidos

## Local server versions
- WordPress 5.2.2
- XAMPP 3.2.2 (without mariaDB)
- PHP 7.2.9
- MySQL 5.6

## Required plugins to use the plugin
- Advanced Custom Fields

## How to use
- Create your own criteria on the Custom Post Type called "criterio" (Include the shortcode called [github-finder] to see the results after.
- After that you can access to **"yourwordpressname/criterios"** to see the list of links with the created criteria.
- Select one link and see the results of the GitHub search with the specific data.
- If you want to switch your plugin to maintenance mode access to the option menu on your admin panel and activate the checkbox. If the checkbox is activated, the [github-finder] shortcode will only show a message.
- PS: You can access to a specific criteria on **yourwordpressname/criterio/name** if you know it.
