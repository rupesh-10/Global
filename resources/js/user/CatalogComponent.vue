<template>
    <div>
        <div id="map">
          <input type="text" name="search" id="search" class="form-control">
        </div>
        <div class="col-10 offset-1 mt-4">
          <form action="">
            <div  class="row">
                <div v-if="packages.length > 0" v-for="packageItem in packages" class="col-3">
                  <div class="card bg-dark text-white m-1 mb-4" style="border-radius: 15px; height: 220px; background:linear-gradient(to right,#2c3e50, #54697e)">
                    <div class="card-header pb-2">
                      <div class="custom-control form-control-lg custom-checkbox">
                        <input type="checkbox" class="custom-control-input" :id="'checkbox_for_'+packageItem.id" name="selectedPackages[]" v-model="selectedPackages" :value="packageItem.id">
                        <label class="custom-control-label" :for="'checkbox_for_'+packageItem.id">
                          <h4>
                            <strong>{{ packageItem.item.name }} (Via {{ packageItem.medium.name }})</strong>
                          </h4>
                        </label>
                      </div>
                    </div>
                    <div class="card-body">
                      <div>
                        <div class="row">
                          <div class="col-6 text-left">
                            Rs. <span style="font-size:18px; font-weight: bolder" v-html="calclulatedAmounts[packageItem.id]"></span>
                          </div>
                          <div class="col-6 text-right">
                            <label style="font-size: 18px; font-weight: bolder;" v-html="selectedQuantities[packageItem.id]"></label>
                          </div>
                        </div>
                        <input type="range" :disabled="!selectedPackages.includes(packageItem.id)" v-model="selectedQuantities[packageItem.id]" @change="updateCalculatedAmounts(packageItem.id)"  class="custom-range" min="1" max="25" step="1" id="amounts[]" name="quantity[]">
                      </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="text-center mt-5">
              <h1>Total Price:</h1>
              <button class="btn btn-success btn-lg">
                Continue {{ totalPrice }}
              </button>
            </div>
          </form>
        </div>
    </div>
</template>

<style scoped>
    #map {
        width: 100%;
        height: 400px;
    }
</style>

<script>
            initOwlCarosel: function() {
              $('.owl-carousel').owlCarousel({
                  loop:false,
                  margin:10,
                  items: 4,
                  touchDrag: false,
                  mouseDrag: false,
                  nav:false,
                  responsive:{
                      0:{
                          items:1
                      },
                      600:{
                          items:3
                      },
                      1000:{
                          items:3
                      },
                      2000:{
                          items:5
                      }
                  }
              })
            },
          
</script>
