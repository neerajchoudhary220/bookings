import { createRouter,createWebHistory} from "vue-router"
import booking from "./pages/booking.vue"
import booking_list from "./pages/booking_list.vue"
import booking_details from "./pages/booking_details.vue"



const routes=[
    {
        path:'/',
        name:'booking_list',
        component:booking_list
    },
    {
        path:'/add',
        name:'Add_booking',
        component:booking
    },
    {
        path:'/edit/:bookingId',
        name:'Edit_booking',
        component:booking

    },

    {
        path:'/details/:bookingId',
        name:'BookingDetails',
        component:booking_details
    }
 
]

const router = createRouter(
    {
        history:createWebHistory(),
        routes
    }
)
export default router