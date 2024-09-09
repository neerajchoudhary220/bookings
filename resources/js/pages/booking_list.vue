<template>
    <div class="container mt-5">
        <h2 class="mb-4">Bookings Management</h2>

        <!-- Search Form -->
        <div class="row mb-3">
            <div class="col-md-4">
                <router-link :to="{ name: 'Add_booking' }">
                    <button class="btn btn-info">Add New Booking</button>
                </router-link>
            </div>

        </div>

        <!-- CRUD Table -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Booking Date</th>
                    <th>Booking Time</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="bookingTable" v-if="bookings">
                <tr v-for="booking, index in bookings">
                    <td>{{ index + 1 }}</td>
                    <td>{{ booking.name }}</td>
                    <td>{{ booking.booking_date }}</td>
                    <td>{{ booking.booking_time }}</td>
                    <td>
                        <div class="d-flex justify-content-around">
                            <router-link :to="{ name: 'BookingDetails', params: { bookingId: booking.id } }">
                                <button class="btn btn-info btn-sm">View</button>
                            </router-link>
                            <router-link :to="{ name: 'Edit_booking', params: { bookingId: booking.id } }">
                                <button class="btn btn-warning btn-sm">Edit</button>
                            </router-link>
                            <button class="btn btn-danger btn-sm" @click="deleteBooking(booking.id)">Delete</button>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
import { onMounted, ref } from 'vue';
import axiosinstance from '../modules/axiosinstance';
export default {
    name: 'Booking',
    setup() {
        const bookings = ref()
        const fetchBookings = () => {
            axiosinstance.get('/booking')
                .then(response => {
                    console.log(response.data.data);
                    bookings.value = response.data.data;
                })
        }

        const deleteBooking = (id) => {
            axiosinstance.delete(`/booking/delete/${id}`)
                .then((res) => {
                    console.log(res.data.message);
                    fetchBookings();
                }).catch((err) => {
                    console.log(err);
                });
        }
        onMounted(() => {
            fetchBookings();
        })

        return { bookings, deleteBooking }
    }

}
</script>