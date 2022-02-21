import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state : {
        contactsList : [],
        contactData : {
            id: '',
            firstName: '',
            lastName: '',
            email: '',
            phone: '',
            birthday: '',
            addresses: [],
        },
        addressData : {
            id: '',
            number: '',
            street: '',
            city: '',
            state: '',
            zip: '',
            type: '',
        },
        deleteContactModalObj : {
            showDeleteModal: false,
            deleteUrl : '',
            data : null,
            deletingIndex: -1,
            isDeleted : false,
        },
        editContactModalObj : {
            showEditModal: false,
            editUrl : '',
            contactData : null,
            editingIndex: -1,
            isEdited : false,
        },
        detailsModalObj : {
            showDetailsModal: false,
            detailsUrl : '',
            contactData : null,
            addressListData : [],
        },
        deleteAddressModalObj : {
            showDeleteAddressModal: false,
            deleteUrl : '',
            addressData : null,
            deletingIndex: -1,
            isDeleted : false,
        },
        editAddressModalObj : {
            showEditModal: false,
            editUrl : '',
            contactData : null,
            editingIndex: -1,
            isEdited : false,
            addressListData: [],
        },
        user: false,
        userPermission: null
    },
    getters: {
        // Contact Modal getters
        getContactData: state => state.contactData,
        getContactList: state =>state.contactsList,
        getDeleteModalObj: state => state.deleteModalObj,
        getEditContactModalObj: state => state.editContactModalObj,

        // Address Modal getters
        getDetailsModalObj: state => state.detailsModalObj,
        getAddressModalObj: state => state.editAddressModalObj,
        getEditAddressModalObj: state => state.editAddressModalObj,
        getEditAddressModalObj: state => state.editAddressModalObj,
        getEditAddressModalObj: state => state.editAddressModalObj,
        // getUserPermission(state){
        //     return state.userPermission
        // },
    },

    mutations: {
        // Contact Mutations
        setContactData(state, contactData) {
            state.contactData = contactData
        },
        setEditingContactModal(state, data){
            const editModalObj = {
                showEditContactModal: false,
                deleteUrl : '',
                data : null,
                isEdited : data,
            }
            state.editModalObj = editModalObj
        },
        setEditingContactModalObj(state, contactData){
            state.editContactModalObj = contactData
        },
        setDeleteContactModal(state, contactData){
            const deleteContactModalObj = {
                showDeleteContactModal: false,
                deleteUrl : '',
                contactData : null,
                deletingIndex: -1,
                isDeleted : contactData,
            }
            state.deleteContactModalObj = deleteContactModalObj
        },
        setDeletingContactModalObj(state, contactData){
            state.deleteContactModalObj = contactData
        },
        // Address Mutations


        // Authentication
        setUpdateUser(state, data){
            state.user = data
        },
        setUserPermission(state, data){
            state.userPermission = data
        },

    },



    // actions :{
    //     changeCounterAction({commit}, data){
    //         commit('changeTheCounter', data)
    //     }
    // }


})
