<template>
  <div>
    <b-modal id="modal-add" ref="modal-add" title="Add Book" @hidden="onReset" hide-footer>
      <b-form ref="form-add" @submit="onSubmit" @reset="onReset" v-if="show">
        <b-form-group id="input-group-title" label="Title" label-for="input-title">
          <b-form-input
            id="input-title"
            v-model="form.title"
            required
            placeholder="Enter title"
          ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-author" label="Author:" label-for="input-author">
          <b-form-input
            id="input-author"
            v-model="form.author"
            required
            placeholder="Enter author"
          ></b-form-input>
        </b-form-group>

        <b-button type="submit" variant="primary">Submit</b-button>
        <b-button type="reset" variant="danger">Reset</b-button>
      </b-form>
    </b-modal>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        form: {
          title: '',
          author: ''
        },
        show: true
      }
    },
    methods: {
      onSubmit(evt) {
        var v = this
        evt.preventDefault()
        axios.post('/api/insertBook', {
          title: this.form.title,
          author: this.form.author
        })
          .then(function (response) {
            v.makeToast('Success', 'Book added.', 'success');
            v.$root.$emit('bookAdded', response.data.data);
            v.$refs['modal-add'].hide();
          })
          .catch(function (error) {
            console.log(error);
          });
      },
      onReset(evt) {
        // Reset our form values
        this.form.title = ''
        this.form.author = ''
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      },
      makeToast(title, message, variant, append = true) {
        this.toastCount++
        this.$bvToast.toast(message, {
          title: title,
          autoHideDelay: 5000,
          appendToast: append,
          variant: variant
        })
      }
    }
  }
</script>
