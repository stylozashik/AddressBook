import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

// contact routes
import index from './Pages/Contacts/index';
import lightsOut from './Pages/Contacts/lights-out';
// import createContact from './Pages/Contacts/createContact'
// import editContact from './Pages/Contacts/editContact'
// import deleteContact from './Pages/Contacts/deleteContact'

// address routes
// import details from './Pages/Addresses/details'
// import createAddress from './Pages/Addresses/createAddress'
// import editAddress from './Pages/Addresses/editAddress'
// import deleteAddress from './Pages/Addresses/deleteAddress'

const routes = [
    // Project routes
    {
        path: '/',
        component: index,
        name: index,
    },
    {
        path: '/lights-out',
        component: lightsOut,
        name: 'lights-out',
    },
    // {
    //     path: '/createContact',
    //     component: createContact,
    //     name: createContact,
    // },
    // {
    //     path: '/editContact/{id}',
    //     component: editContact,
    //     name: editContact,
    // },
    // {
    //     path: '/deleteContact',
    //     component: deleteContact,
    //     name: deleteContact,
    // },
    // {
    //     path: '/details',
    //     name: details,
    //     component: details,
    // },
    // {
    //     path: '/createAddress',
    //     component: createAddress,
    // },
    // {
    //     path: '/editAddress/{id}',
    //     component: editAddress,
    //     name: editAddress,
    // },
    // {
    //     path: '/deleteAddress',
    //     component: deleteAddress,
    // },
]

export default new Router({
    mode: 'history',
    routes,
})
