<template>
  <div>
      
      <div class="review">

          <div id="click-collapse" class="ms_row-info" data-bs-toggle="collapse" data-bs-target="#review-wrap" aria-expanded="false" aria-controls="review-wrap">
            <h3 @click="changeArrow()">Scrivi una recensione <i class="fa-solid" :class="(arrow === true)? 'fa-angle-down' : 'fa-angle-up' "></i></h3> 
          </div>

          <!-- FORM RECENSIONE -->
          <div class="collapse" id="review-wrap">

            <form>

              <!-- INIZIO VOTO -->
              <div id="star-vote" class="mb-3">
                <p>Da 1 a 5 come valuteresti la visita?</p>
                <input v-for="i in 5" :key="i" type="radio" :id="'star' + i" name="rating" :value="i" v-model="voteValue">
                <label v-for="i in 5" :key="'a' + i" :for="'star' + i">
                  <i class="fa-star fa-solid"></i>
                </label>
              </div>
              <!-- FINE VOTO -->

              <!-- TITOLO -->
              <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" aria-describedby="title" placeholder="Scrivi un titolo per la recensione">
              </div>

              <!-- NOME AUTORE -->
              <div class="mb-3">
                <label for="name" class="form-label">Il tuo nome</label>
                <input type="text" class="form-control" id="name" placeholder="Scrivi il tuo nome">
              </div>

              <!-- TESTO RECENSIONE -->
              <div class="mb-3">
                <label for="text-review" class="form-label">Scrivi la recensione</label>
                <textarea class="form-control" id="text-review" rows="3"></textarea>
              </div>
              
              <!-- BUTTON SUBMIT -->
              <button type="submit" class="btn btn-success text-white">Pubblica</button>
            </form>

          </div>   

      </div>
  </div>
</template>

<script>

  export default {
    name: 'SingleDoctorReview',

    data() {
      return {
          arrow: true,

          voteValue: '',
          // goldStarValue: false,

      }
    },

    methods: {

      changeArrow() {
        this.arrow = !this.arrow;
      },
      
    }
  }

</script>

<style lang="scss" scoped>
  @import '../../sass/doctor/main.scss';
</style>