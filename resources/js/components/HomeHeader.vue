<template>

  <header>

    <div id="header">
      
      <!-- CONTAINER HEADER -->
      <div id="head-container">

          <h1>BDoctors.it</h1>

          <!-- BUTTON -->
          <div class="btn-head">
              <a href="/register" type="button" class="btn btn-reg px-4 py-2">Registrati</a>
              <a href="/register" type="button" class="btn btn-login py-2"">Accedi</a>
          </div>

      </div>

    </div>

  </header>

</template>

<script>

export default {

  name: "HomeHeader",

}

</script>

<style lang="scss" scoped>

  @import '../../sass/home/homeheader.scss';

</style>