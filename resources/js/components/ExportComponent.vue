<template>
  <b-container fluid>
    <div>
      <b-form-group label="Check the fields to be exported:">
        <b-form-checkbox-group
          id="checkbox-group-exported-fields"
          v-model="selectedFields"
          :options="fields"
          name="exported-fields"
        ></b-form-checkbox-group>
      </b-form-group>
      <b-form-group label="File Format">
        <b-form-radio-group
          id="radio-group-exported-format"
          v-model="selectedFormat"
          :options="formats"
          name="exported-format"
        ></b-form-radio-group>
      </b-form-group>
      <b-button v-on:click="exportToExcel">Export</b-button>
    </div>
  </b-container>
</template>

<script>
  export default {
    data() {
      return {
        selectedFields: ['title','author'],
        selectedFormat: 'xlsx',
        fields: [
          { text: 'Title', value: 'title' },
          { text: 'Author', value: 'author' }
        ],
        formats: [
          'xlsx',
          'csv'
        ]
      }
    },
    methods: {
      exportToExcel: _exportToExcel
    }
  }

  function _exportToExcel (event) {
    var url = window.location.host;
    var withTitle = this.selectedFields.includes("title") ? 1 : 0;
    var withAuthor = this.selectedFields.includes("author") ? 1 : 0;
    if (this.selectedFormat == 'xlsx') {
      url = 'exportToExcel?withTitle=' + withTitle + '&withAuthor=' + withAuthor
    } else if (this.selectedFormat == 'csv') {
      url = 'exportToCSV?withTitle=' + withTitle + '&withAuthor=' + withAuthor
    }
    window.location = url;
  }
</script>
