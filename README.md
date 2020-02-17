# Coding assignment for Yaruku
http://ec2-52-40-57-226.us-west-2.compute.amazonaws.com/


## Feature Specification
- The attached image file is an example but feel free to solve the tasks in
whatever manner you think is best and with the layout you consider to be the
best.
- Use Laravel ([http://laravel.com](http://laravel.com/)) for the backend.
- Any persistence is okay, MySQL, SQLite etc. Just choose the one that feels
most convenient.
- Create a list of books, with the following functions,
    - Add a book to the list.
    - Delete a book from the list.
    - Change an authors name
    - Sort by title or author
    - Search for a book by title or author
    - Export the following in CSV and XML
        - A list with Title and Author
        - A list with only Titles
        - A list with only Authors
        
## Implemented Features
- Used Laravel for the backend.
- Used SQLite for convinency.
- Create a list of books.
    - Add a book to the list.
    - Delete a book from the list.
    - Change an authors name.
    - Sort by title or author.
    - Search for a book by title or author.
    - Export the following in CSV and XML
        - A list with Title and Author
        - A list with only Titles
        - A list with only Authors
- Deployed to an ubuntu server running nginx on Amazon EC2. ([http://ec2-52-40-57-226.us-west-2.compute.amazonaws.com/](http://ec2-52-40-57-226.us-west-2.compute.amazonaws.com/))

## Directory Structure
- app
    - Exports
    - DataStores
    - Http
        - Controllers
            - API
        - Resources
    - Models
        - API
    - Repositories
- resources
    - js
        - components
    - views
    
The **app/Exports** directory contains a class for exporting to excel or csv.

The **app/DataStores** directory contains data stores for domains or models.

The **app/Http/Controllers/API** directory contains the controllers for api.

The **app/Http/Resources** directory contains the api resources for transforming Eloquent models to JSON.

The **app/Http/Models** directory contains Eloquent models for the application.

The **app/Http/Models/API** directory contains models for the api.

The **app/Repositories** directory contains repositories that are injected to the controllers.

The **resource/js/components** directory contains bootsrap-vue components.

The **resource/views** directory contains blade templates.

    
