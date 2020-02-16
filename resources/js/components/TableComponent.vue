<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
      <b-col lg="4" class="my-1">
        <b-form-group
          label="Sort"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="sortBySelect"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-select v-model="sortBy" id="sortBySelect" :options="sortOptions" class="w-75">
              <template v-slot:first>
                <option value="">-- none --</option>
              </template>
            </b-form-select>
            <b-form-select v-model="sortDesc" size="sm" :disabled="!sortBy" class="w-25">
              <option :value="false">Asc</option>
              <option :value="true">Desc</option>
            </b-form-select>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col lg="4" class="my-1">
        <b-form-group
          label="Filter"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="filterInput"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              v-model="filter"
              type="search"
              id="filterInput"
              placeholder="Type to Search"
            ></b-form-input>
            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col lg="4" class="my-1">
        <b-form-group
          label="Filter On"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          description="Leave all unchecked to filter on all data"
          class="mb-0">
          <b-form-checkbox-group v-model="filterOn" class="mt-1">
            <b-form-checkbox value="title">Title</b-form-checkbox>
            <b-form-checkbox value="author">Author</b-form-checkbox>
          </b-form-checkbox-group>
        </b-form-group>
      </b-col>
    </b-row>

    <!-- Main table element -->
    <b-table
      show-empty
      small
      stacked="md"
      :items="items"
      :fields="fields"
      :filter="filter"
      :filterIncludedFields="filterOn"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
    >
      <template v-slot:cell(name)="row">
        {{ row.value.first }} {{ row.value.last }}
      </template>

      <template v-slot:cell(actions)="row">
        <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
          Edit Author
        </b-button>
        <b-button size="sm" @click="deleteBook(row.item, $event.target)">
          Delete
        </b-button>
      </template>
    </b-table>

    <!-- Info modal -->
    <b-modal :id="infoModal.id" :title="infoModal.title" @hide="resetInfoModal" @ok="updateBook(infoModal.content, $event.target)">
      <b-form-input v-model="infoModal.content.author" placeholder=""></b-form-input>
    </b-modal>
  </b-container>
</template>

<script>
  export default {
    data() {
      return {
        items: [
          { title: 'test', author: 'testy' }
        ],
        fields: [
          { key: 'title', label: 'Title', sortable: true },
          { key: 'author', label: 'Author', sortable: true },
          { key: 'actions', label: 'Actions' }
        ],
        totalRows: 1,
        sortBy: '',
        sortDesc: false,
        sortDirection: 'asc',
        filter: null,
        filterOn: [],
        infoModal: {
          id: 'info-modal',
          title: '',
          content: {
            id: '',
            title: '',
            author: ''
          }
        }
      }
    },
    computed: {
      sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      }
    },
    mounted() {
      axios
        .get('http://127.0.0.1:8000/api/getBooks')
        .then(response => (this.items = response.data.data))
      this.totalRows = this.items.length
    },
    methods: {
      info(item, index, button) {
        this.infoModal.title = item.title
        this.infoModal.content = { id: item.id, title: item.title, author: item.author }
        this.$root.$emit('bv::show::modal', this.infoModal.id, button)
      },
      resetInfoModal() {
        this.infoModal.title = ''
        this.infoModal.content = { id: '', title: '', author: '' }
      },
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
      },
      deleteBook : deleteBook,
      updateBook: updateBook
    }
  }

  function deleteBook(item, button) {
    var items = this.items;
    axios.post('/api/deleteBook', {
      id: item.id
    })
      .then(function (response) {
        items.pop(item);
      })
      .catch(function (error) {
        console.log(error);
      });
  }

  function updateBook(item, button) {
    var items = this.items;
    axios.post('/api/updateBook', {
      id: item.id,
      title: item.title,
      author: item.author
    })
      .then(function (response) {
        items.find(i => i.id == item.id).author = item.author;
      })
      .catch(function (error) {
        console.log(error);
      });
  }
</script>
