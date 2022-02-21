<script>
import axios from 'axios';
import pagination from 'laravel-vue-pagination';

export default {
    // name:"contacts",
    // components:{
    //     pagination
    // },
	data() {
		return {
            contacts : {},
            // meta : {},
			currentContact : {
                id : '',
                firstName : '',
                lastName : '',
                email : '',
                phone : '',
                birthday: '',
                addresses : [],
            },
            // for 'sortable' api
            contactTable: [
                {
                    title: 'First Name',
                    key: 'firstName',
                    sortable: true,
                },               {
                    title: 'Last Name',
                    key: 'lastName',
                    sortable: true,
                },                {
                    title: 'email',
                    key: 'email',
                    sortable: true,
                },                {
                    title: 'phone',
                    key: 'phone',
                    sortable: true,
                },                {
                    title: 'birthday',
                    key: 'birthday',
                    sortable: true,
                },
            ],

            ///////<--- Contact Create/Edit Modals --->///////
            formValidate: {
                id: '',
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                birthday: '',
            }, // may not need, just use currentContact?
            ruleValidate: {
                firstName: [
                    { required: true, message: 'The first name cannot be empty', trigger: 'blur' }
                ],
                lastName: [
                    { required: true, message: 'The last name cannot be empty', trigger: 'blur' }
                ],
                email: [
                    { required: true, message: 'Email cannot be empty', trigger: 'blur' },
                    { type: 'email', message: 'Incorrect email format', trigger: 'blur' }
                ],
                phone: [
                    { required: true, message: 'Please enter a phone number', trigger: 'change' }
                ],
                date: [
                    { required: true, type: 'date', message: 'Please select a birthday', trigger: 'change' }
                ],
            },
            modalContactAdd : false,
            modalContactEdit : false,
            modalContactDetails : false,
            ///////<--- Address Modals --->///////
            addresses : [],
            currentAddress: {
                id: '',
                number: '',
                street: '',
                city: '',
                state: '',
                zip: '',
                type: '',
                contact_id: '',
            },
            formValidateAddress: {
                id: '',
                number: '',
                street: '',
                city: '',
                state: '',
                zip: '',
                type: '',
                contact_id: '',
            },
            ruleValidateAddress: {
                number: [
                    { required: true, type: 'number', message: 'Please enter the house number', trigger: 'change' }
                ],
                street: [
                    { required: true, message: 'Please enter a street', trigger: 'change' }
                ],
                city: [
                    { required: true, message: 'Please enter a city', trigger: 'change' },
                ],
                state: [
                    { required: true, message: 'Please enter a state', trigger: 'change' }
                ],
                zip: [
                    { required: true, type: 'number', message: 'Please enter a zip code', trigger: 'change' }
                ],
                type: [
                    { required: true, message: 'Please select a type', trigger: 'change' }
                ],
            },
            modalAddressAdd : false,
            modalAddressEdit : false,
        }
    },

    mounted() {
        this.getContacts();
        this.initModals();
    },

    methods: {
        initModals() {
            this.modalContactAdd = new bootstrap.Modal(document.getElementById('modalContactAdd'), {});
            this.modalContactEdit = new bootstrap.Modal(document.getElementById('modalContactEdit'), {});
            this.modalContactDetails = new bootstrap.Modal(document.getElementById('modalContactDetails'), {});
            this.modalAddressAdd = new bootstrap.Modal(document.getElementById('modalAddressAdd'), {});
            this.modalAddressEdit = new bootstrap.Modal(document.getElementById('modalAddressEdit'), {});
        },

        changePage(page){
            this.emit('pagination', page)
        },
    ////////////////////<--- Contact Functions --->////////////////////
        async getContacts(page) {
            await axios.get(`/api/contacts?page=` + page)
                .then(response => {
                    this.contacts = response.data;
                });
            // try {
            //     const response = await axios.get('/api/contacts', {
            //         params:{page}
            //     });
            //     this.contacts = response.data;
            // } catch (err) {
            //     alert(err);
            // }
        },
        btnCreateContact(){
            this.currentContact = {};
            this.modalContactAdd.show();
        },
        async btnEditContact(id) {
            try {
                const response = await axios.get(`/api/contacts/${id}`);
                this.currentContact = response.data;
                this.modalContactEdit.show();
            } catch (err) {
                alert(err);
            }
        },
        async btnDeleteContact(id) {
            if (confirm('Are you sure you want to delete this item?')) {
                try {
                await axios.delete(`/api/contacts/${id}`);
                this.getContacts();
                } catch (err) {
                alert(err);
                }
            }
        },
        async modalAddSubmit() {
            try {
                const response = await axios.post(`/api/contacts`, this.currentContact);
                if (response.data.errors) {
                alert('All fields are required');
                } else {
                this.modalContactAdd.hide();
                this.getContacts();
                }
            } catch (err) {
                alert(err);
            }
        },
        async modalEditSubmit() {
            try {
                await axios.put(`/api/contacts/${this.currentContact.id}`, this.currentContact);
                this.modalContactEdit.hide();
                this.getContacts();
            } catch (err) {
                alert(err);
            }
        },
    ////////////////////<--- Address Modals --->////////////////////
        async btnDetails(id) {
            try {
                const response = await axios.get(`/api/contacts/${id}`);
                this.currentContact = response.data;
                this.modalContactDetails.show();
            } catch (err) {
                alert(err);
            }
        },

        btnCreateAddress(){
            this.currentAddress = {};
            this.modalAddressAdd.show();
        },

        async btnEditAddress(id) {
            try {
                const response = await axios.get(`/api/addresses/${id}`);
                this.currentAddress = response.data;
                this.modalAddressEdit.show();
            } catch (err) {
                alert(err);
            }
        },

        async btnDeleteAddress(id) {
            if (confirm('Are you sure you want to delete this address?')) {
                try {
                await axios.delete(`/api/addresses/${id}`);
                this.btnDetails(this.currentContact.id);
                } catch (err) {
                alert(err);
                }
            }
        },

        async modalAddressAddSubmit() {
            try {
                this.currentAddress.contact_id = this.currentContact.id;
                const response = await axios.post(`/api/addresses`, this.currentAddress);
                if (response.data.errors) {
                    alert('All fields are required');
                } else {
                this.modalAddressAdd.hide();
                this.btnDetails(this.currentContact.id);
                }
            } catch (err) {
                alert(err);
            }
        },
        async modalAddressEditSubmit() {
            try {
                // console.log(this.currentAddress);
                const response = await axios.put(`/api/addresses/${this.currentAddress.id}`, this.currentAddress);
                // console.log(response);
                if (response.data.errors) {
                    alert('All fields are required');
                } else {
                this.modalAddressEdit.hide();
                this.btnDetails(this.currentContact.id);
                }
            } catch (err) {
                alert(err);
            }
        },
    }
}
</script>

<template>
    <div>
       <div class="content">
			<div class="container-fluid">
                <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
                <h1 class="mt-0 pt-0 pb-2">Contacts</h1>
                <hr class="mb-3">
                <Button type="success" @click="btnCreateContact()">New Contact</Button>
                <div class="_overflow _table_div">
                    <table class="_table" :columns="contactTable" >
                            <!-- TABLE TITLE -->
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Birthday</th>
                            <th>Action</th>
                        </tr>
                            <!-- ITEMS -->
                        <tr v-for="contact in contacts.data" :key="contact.id">
                            <td>{{contact.id}}</td>
                            <td>{{contact.firstName}}</td>
                            <td>{{contact.lastName}}</td>
                            <td>{{contact.email}}</td>
                            <td>{{contact.phone}}</td>
                            <td>{{contact.birthday}}</td>
                            <td>
                                <Button type="primary" size="small" @click="btnDetails(contact.id)">Details</Button>
                                <Button type="warning" size="small" @click="btnEditContact(contact.id)">Edit</Button>
                                <button type="button" class="btn btn-sm btn-secondary" @click="btnDeleteContact(contact.id)">Delete</button>
                            </td>
                        </tr>
                            <!-- ITEMS -->
                    </table>
                    <pagination :data="contacts" @pagination-change-page="getContacts"></pagination>
                    <!-- <div class="d-flex justify-content-center">
                        {{!! $contacts->links() !!}}
                    </div> -->
                    <!-- <pagination align="center" :data="contacts" @pagination-change-page="getContacts"></pagination> -->
				</div>


                <!-- Add Contact Modal -->
                <div id="modalContactAdd" class="modal" tabindex="-1">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Add Contact</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">First</label>
                            <input v-model="currentContact.firstName" type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last</label>
                            <input v-model="currentContact.lastName" type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input v-model="currentContact.email" type="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input v-model="currentContact.phone" type="tel" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Birthday</label>
                            <input v-model="currentContact.birthday" type="text" class="form-control" required>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-primary" @click="modalAddSubmit()">Save Changes</button>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Edit Contact Modal -->
                <div id="modalContactEdit" class="modal" tabindex="-1">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Edit Contact</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">First</label>
                            <input v-model="currentContact.firstName" type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last</label>
                            <input v-model="currentContact.lastName" type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input v-model="currentContact.email" type="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input v-model="currentContact.phone" type="tel" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Birthday</label>
                            <input v-model="currentContact.birthday" type="text" class="form-control" required>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-primary" @click="modalEditSubmit()">Save Changes</button>
                        </div>
                    </div>
                    </div>
                </div>

<!------------------------------------- Details Modal ------------------------------------------------------>
                <div id="modalContactDetails" class="modal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width:175%">
                            <div class="modal-header">
                                <h5 class="modal-title">Contact Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Name: {{ currentContact.firstName }} {{ currentContact.lastName }} <br>
                                Email: {{ currentContact.email }} <br>
                                Phone: {{ currentContact.phone }} <br>
                                Birthday: {{ currentContact.birthday }}
                                <div class="mt-2">
                                    <strong>Addresses</strong>
                                    <hr class="mb-2">
                                    <Button type="success" @click="btnCreateAddress()">New Address</Button>
                                    <table class="_table mt-3">
                                        <tr>
                                            <th>ID</th>
                                            <th>Numnber</th>
                                            <th>Street</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Zip</th>
                                            <th>Type</th>
                                            <th>Actions</th>
                                        </tr>
                                        <tr v-for="address in currentContact.addresses" :key="address.id">
                                            <td>{{ address.id }}</td>
                                            <td>{{ address.number }}</td>
                                            <td>{{ address.street }}</td>
                                            <td>{{ address.city }}</td>
                                            <td>{{ address.state }}</td>
                                            <td>{{ address.zip }}</td>
                                            <td>{{ address.type }}</td>
                                            <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-sm btn-secondary" @click="btnEditAddress(address.id)">Edit</button>
                                                <button type="button" class="btn btn-sm btn-secondary" @click="btnDeleteAddress(address.id)">Delete</button>
                                            </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
<!--------------------------------------------- Address Modals ----------------------------------------------->
                <!-- Add Address Modal -->
                <div id="modalAddressAdd" class="modal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Address</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Number</label>
                                    <input v-model="currentAddress.number" type="number" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Street</label>
                                    <input v-model="currentAddress.street" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <input v-model="currentAddress.city" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">State</label>
                                    <input v-model="currentAddress.state" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Zip</label>
                                    <input v-model="currentAddress.zip" type="number" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-12 control-label" for="month">Type</label>
                                    <div class="col-md-4 col-sm-12">
                                        <select v-model="currentAddress.type" type="text" class="form-control">
                                            <option value="home">Home</option>
                                            <option value="work">Work</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Contact ID</label>
                                    <input v-model="currentContact.id" type="number" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-sm btn-primary" @click="modalAddressAddSubmit()">Save Address</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Address Modal -->
                <div id="modalAddressEdit" class="modal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title">Edit Address</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Number</label>
                                <input v-model="currentAddress.number" type="number" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Street</label>
                                <input v-model="currentAddress.street" type="text" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">City</label>
                                <input v-model="currentAddress.city" type="text" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">State</label>
                                <input v-model="currentAddress.state" type="text" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Zip</label>
                                <input v-model="currentAddress.zip" type="number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-sm-12 control-label" for="month">Type</label>
                                <div class="col-md-4 col-sm-12">
                                    <select v-model="currentAddress.type" type="text" class="form-control">
                                        <option value="home">Home</option>
                                        <option value="work">Work</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contact ID</label>
                                <input v-model="currentContact.id" type="number" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-sm btn-primary" @click="modalAddressEditSubmit()">Save Changes</button>
                        </div>
                    </div>
                    </div>
                </div>

			</div>
		</div>
        <!-- {{$contacts=>links()}} -->
    </div>
</template>

