<template>
  <div class="container mt-5">
    <h2 class="mb-4">{{ pageHeading }}</h2>
    <div class="border border-secondary rounded p-3">
      <form @submit.prevent="submitForm" novalidate>
        <div class="row">
          <!-- Name Field -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" v-model="name" class="form-control" id="name" placeholder="Enter your name" required>
              <span v-if="errors && errors.name" class="text-danger">{{
                errors.name[0] }}</span>
            </div>
          </div>

          <!-- Email Field -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" v-model="email" class="form-control" id="email" placeholder="Enter your email"
                required>
              <span v-if="errors && errors.email" class="text-danger">{{
                errors.email[0] }}</span>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- Booking Type Field -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="booking_type">Booking Type</label>
              <select v-model="booking_type" class="form-control" id="bookingType" required>
                <option value="">Select Booking Type</option>
                <option value="full_day">Full Day</option>
                <option value="half_day">Half Day</option>
              </select>
              <span v-if="errors && errors.booking_type" class="text-danger">{{
                errors.booking_type[0] }}</span>
            </div>
          </div>

          <!-- Booking Date Field -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="booking_date">Booking Date</label>
              <input type="date" v-model="booking_date" class="form-control" id="bookingDate" required>
              <span v-if="errors && errors.booking_date" class="text-danger">{{
                errors.booking_date[0] }}</span>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- Booking Slot Field -->
          <div class="col-md-6">
            <div class="form-group">
              <label>Booking Slot</label>
              <div>
                <div class="form-check form-check-inline">
                  <input type="radio" v-model="booking_slot" id="morningSlot" value="morning" class="form-check-input"
                    required>
                  <label class="form-check-label" for="morningSlot">Morning</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="radio" v-model="booking_slot" id="eveningSlot" value="evening" class="form-check-input"
                    required>
                  <label class="form-check-label" for="eveningSlot">Evening</label>
                </div><br>
                <span v-if="errors && errors.booking_slot" class="text-danger">{{
                  errors.booking_slot[0] }}</span>
              </div>
            </div>
          </div>

          <!-- Booking Time Field -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="bookingTime">Booking Time</label>
              <input type="time" v-model="booking_time" class="form-control" id="bookingTime" required>
              <!-- <input type="time" value ="17:00" class="form-control" id="bookingTime" required> -->

              <span v-if="errors && errors.booking_time" class="text-danger">{{
                errors.booking_time[0] }}</span>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center mt-3">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { onMounted, reactive, ref, toRefs } from 'vue';
import axiosinstance from '../modules/axiosinstance'
import { useRouter, useRoute } from "vue-router";
import Bookings from '../modules/booking';


export default {
  setup() {
    const form = reactive({
      name: '',
      email: '',
      booking_type: '',
      booking_date: '',
      booking_slot: '',
      booking_time: '',
    });

    const { bookingDetails } = Bookings()
    const router = useRouter()
    const route = useRoute(0)
    const booking_id = route.params.bookingId
    const pageHeading =ref('Add New Booking')

    const errors = reactive({});

    const clearErrors = () => {

      for (const key in errors) {
        if (Array.isArray(errors[key])) {
          errors[key] = [""];
        } else {
          errors[key] = "";
        }
      }
    }
    const resetForm = () => {
      Object.keys(form).forEach(key => {
        form[key] = '';
      });
    }

    const fetchBookingsDetails = async () => {
      if (booking_id) {
        pageHeading.value='Edit Bookings'
        const res = await bookingDetails(booking_id)
        console.log(res.data.data);

        if (res.status == 200) {
          form.name = res.data.data.name;
          form.email = res.data.data.email;
          form.booking_type = res.data.data.booking_type;
          form.booking_date = res.data.data.booking_date;
          form.booking_slot = res.data.data.booking_slot;
          form.booking_time = res.data.data.booking_time;
        }
      }
    }


    const submitForm = async () => {
      clearErrors()
      const uRL = (booking_id) ? `/booking/update/${booking_id}` : 'booking/add'

      axiosinstance.post(uRL, form).then((res) => {
        if (res.status == 200) {
          resetForm();
          router.push({ name: 'booking_list' })

        }
      }).catch((error) => {
        console.log(error.response.data.errors);
        if (error.response) {
          if (error.response && error.response.status === 422) {

            Object.assign(errors, error.response.data.errors);
          }
        }

        // resetForm();
      }).finally(() => {
        // resetForm();
      })



    };

    onMounted(async () => {
      await fetchBookingsDetails()
    })


    return { submitForm, errors, ...toRefs(form),pageHeading };
  }
};
</script>

<style scoped>
/* Optional: Add some padding and layout enhancements */
.form-group {
  margin-bottom: 1.5rem;
}

button {
  width: 150px;
}
</style>