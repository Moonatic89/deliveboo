<template>
  <div class="container mx-auto">
    <div class="steps-title pt-5">
      <div class="line"></div>
      <h3>Come funziona?</h3>
      <div class="line"></div>
    </div>
    <div class="steps py-5">
      <div class="step shadow p-2 m-2 mt-0">
        <img src="img/restaurant.png" class="steps-icon" />
        <h5>Scegli un ristorante</h5>
      </div>
      <div class="step shadow p-2 m-2 mt-0">
        <img src="img/credit-card.png" class="steps-icon" />
        <h5>Paga con carta di credito</h5>
      </div>
      <div class="step shadow p-2 m-2 mt-0">
        <img src="img/rider.png" class="steps-icon" />
        <h5>Aspetta la consegna</h5>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.steps-title {
  display: flex;
  justify-content: center;
  text-align: center;

  .line {
    height: 5px;
    width: 140px;
    background-color: #fece2c;
    align-items: center;
    margin-top: 15px;
  }

  h3 {
    align-items: center;
    font-size: 25px;
    font-weight: bold;
    margin-left: 10px;
    margin-right: 10px;
  }
}

.steps {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;

  .step {
    width: 240px;
    height: 120px;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    align-items: center;
    border-radius: 0.5rem;

    .steps-icon {
      width: 45px;
    }

    h5 {
      font-size: 1.2rem;
    }
  }
}
</style>