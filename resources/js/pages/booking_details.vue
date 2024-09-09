<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        Booking Details
                    </div>
                    <div class="card-body" v-if="bookings">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="item-label">Name:</span> {{ bookings.name }}
                            </li>
                            <li class="list-group-item">
                                <span class="item-label">Email:</span>{{ bookings.email }}
                            </li>
                            <li class="list-group-item">
                                <span class="item-label">Booking Type:</span> {{ bookings.booking_type }}
                            </li>
                            <li class="list-group-item">
                                <span class="item-label">Booking Date:</span> {{ bookings.booking_date }}
                            </li>
                            <li class="list-group-item">
                                <span class="item-label">Booking Slot:</span> {{ bookings.booking_slot }}
                            </li>
                            <li class="list-group-item">
                                <span class="item-label">Booking Time:</span> {{ bookings.booking_time }}
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <router-link :to="{ name: 'booking_list' }">
                            <button class="btn btn-secondary">Back</button>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Bookings from '../modules/booking';
import { onMounted,ref } from 'vue'
import { useRoute } from "vue-router";


export default {
    name: 'Booking_details',


    setup() {
        const { bookingDetails } = Bookings()
        const bookings = ref()
        const route = useRoute(0)
        const booking_id = route.params.bookingId

        const fetchBookingsDetails = async () => {
            if (booking_id) {
                const res = await bookingDetails(booking_id)
                bookings.value = res.data.data


            }
        }
        onMounted(async () => {
            await fetchBookingsDetails()
        })
        return {bookings}
    }
}
</script>

<style>
.card {
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-header {
    background-color: #007bff;
    color: #fff;
    font-size: 1.5rem;
    border-bottom: 0;
    border-radius: 15px 15px 0 0;
}

.card-body {
    font-size: 1.1rem;
}

.d-flex {
    justify-content: space-between;
}

.item-label {
    font-weight: bold;
}
</style>