<!DOCTYPE html>
<html>
    <head>
      <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
      <div id="app">
        <table-component></table-component>
        <add-component></add-component>
        <export-component></export-component>
        <b-container fluid>
          <b-button v-b-modal.modal-add>Add</b-button>
          <b-button v-b-modal.modal-export>Export</b-button>
        </b-container>
      </div>
      <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
