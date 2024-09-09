import axiosinstance from "./axiosinstance"
export default  function Bookings(){

    const bookingDetails=async(bookingId)=>{
        const bookingsDetails  = await axiosinstance.get(`/booking/details/${bookingId}`);
        return bookingsDetails;
        
    }

    return{
        bookingDetails
    }
}