<template>
    <div>
      <b-modal id="modal-export" ref="modal-export" title="Export" hide-footer>
        <b-form-group label="Check the fields to be exported:">
          <b-form-checkbox-group
            id="checkbox-group-exported-fields"
            v-model="selectedFields"
            :options="fields"
            name="exported-fields"
          ></b-form-checkbox-group>
        </b-form-group>
        <b-form-group label="File Format:">
          <b-form-radio-group
            id="radio-group-exported-format"
            v-model="selectedFormat"
            :options="formats"
            name="exported-format"
          ></b-form-radio-group>
        </b-form-group>
        <b-form-group label="Check to include headers:">
        <b-form-checkbox
          id="checkbox-1"
          v-model="includeHeaders"
          name="checkbox-1"
        >
        </b-form-checkbox>
        </b-form-group>
        <b-button v-on:click="exportToExcel">Export</b-button>
      </b-modal>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        includeHeaders: false,
        selectedFields: ['title','author'],
        selectedFormat: 'xlsx',
        fields: [
          { text: 'Title', value: 'title' },
          { text: 'Author', value: 'author' }
        ],
        formats: ['xlsx','csv']
      }
    },
    methods: {
      exportToExcel: _exportToExcel
    }
  }

  function _exportToExcel (event) {
    var url = window.location.host;

    var withHeaders = this.includeHeaders ? 1 : 0;
    var withTitle = this.selectedFields.includes("title") ? 1 : 0;
    var withAuthor = this.selectedFields.includes("author") ? 1 : 0;

    if (this.selectedFormat == 'xlsx') {
      url = 'exportToExcel';
    } else if (this.selectedFormat == 'csv') {
      url = 'exportToCSV';
    }

    window.location = url + '?withTitle=' + withTitle + '&withAuthor=' + withAuthor + '&withHeaders=' + withHeaders;

    this.$refs['modal-export'].hide();
  }
</script>
