<template>
  <div>

    <form @submit.prevent="sendForm">
        <!-- Inserire nome utente -->
        <div class="form-group">
            <label class="mb-3" for="author">Nome e Cognome</label>
            <input type="text" class="form-control" :class="{'is-invalid':errors.author}" id="author" name="author" v-model="author">
            <p v-for="(error, index) in errors.author" :key="'error_author'+index" class="invalid-feedback">
                {{error}}
            </p>
        </div>

        <!-- Inserire email utente -->
        <div class="form-group">
            <label class="mb-3" for="email">Inserisci la tua email</label>
            <input type="email" class="form-control" :class="{'is-invalid':errors.email}" id="email" name="email" v-model="email">
            <p v-for="(error, index) in errors.email" :key="'error_email'+index" class="invalid-feedback">
                {{error}}
            </p>
        </div>

        <!-- Motivo del contatto -->
        <div class="form-group">
            <label class="mb-3" for="message">Messaggio</label>
            <textarea class="form-control" :class="{'is-invalid':errors.message}" id="message" rows="6" name="message" v-model="message"></textarea>
            <p v-for="(error, index) in errors.message" :key="'error_message'+index" class="invalid-feedback">
                {{error}}
            </p>
        </div>

         <button type="submit" class="px-4 mt-3 btn btn-success">{{sendingInProgress? 'Invio in corso...':'Invia'}}</button>
    </form>

  </div>
</template>

<script>
export default {

  name: 'SingleDoctorForm',

  data() {

      return {
          
        author: '',
        email: '',
        message: '',
        sendingInProgress: false,
        errors: {},
        success: false,
        doctor: null
      }
        
  },

  methods: {
        sendForm() {
            this.sendingInProgress = true;
            axios.post('/api/single-doctor', {
                'author': this.author,
                'email' : this.email,
                'message': this.message,
            }).then(res => {
                this.sendingInProgress = false;
                if(res.data.errors) {
                    this.errors = res.data.errors;
                    this.success = false;
                } else {
                    this.succcess = true;
                    this.author = '',
                    this.email= '',
                    this.errors = {};
                }
            });
        }
    },
    mounted() {
        const slug = this.$route.params.slug;
        axios.get('/api/doctors/' + slug).then(res => {
            if(res.data.success == false) {
                abort(404, 'not found');
            } else {
                this.doctor = res.data.results;
            }
        })
    }
}

</script>

<style>

</style>