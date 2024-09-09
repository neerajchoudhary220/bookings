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
            <tbody id="bookingTable" v-if="bookings && bookings.length > 0">
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
            <tfoot v-else>
                <tr>
                    <td colspan="5" class="text-center">No bookings found.</td>
                </tr>

            </tfoot>

            <tfoot v-if="bookings">

                <tr>
                    <td colspan="5">
                        <div v-if="paginators" class="mt-3 text-start">
            <div class="m-auto">
                <button v-for="page in paginators" :disabled="page.url === null" class="btn mx-1 mb-2"
                    :class="{ 'btn-info': page.active, 'btn-dark': !page.active }" :value="page.url"
                    @click="changePage(page.url)" v-html="page.label">
                </button>
            </div>
            


        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
      

    </div>
</template>

<script>
import { onMounted, ref } from 'vue';
import axiosinstance from '../modules/axiosinstance';
export default {
    name: 'Booking',
    setup() {
        const paginators = ref()
        const bookings = ref()
        const link = ref(`/booking`)

        const fetchBookings = () => {
            axiosinstance.get(link.value)
                .then(response => {
                    console.log(response.data.data);
                    bookings.value = response.data.data;
                    paginators.value = response.data.meta.links
                })
        }
        const changePage = (url) => {
            link.value = url
            fetchBookings()  // Fetch movie data when changing page
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

        return { bookings, deleteBooking, paginators, changePage }
    }

}
</script>