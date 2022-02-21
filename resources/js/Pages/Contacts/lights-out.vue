<script>
import axios from 'axios';

export default {
	data() {
		return {
      contacts: [],
      currentContact: {},
      modalContactDetails: null,
      modalContactEdit: null,
      modalContactAdd: null,
    }
  },
  mounted() {
    this.getContacts();
    this.initModals();
  },
  methods: {
    initModals() {
      this.modalContactEdit = new bootstrap.Modal(document.getElementById('modalEdit'), {});
      this.modalContactAdd = new bootstrap.Modal(document.getElementById('modalAdd'), {});
      this.modalContactDetails = new bootstrap.Modal(document.getElementById('modalDetails'), {});
    },
    async getContacts() {
      try {
        const response = await axios.get('/api/contacts');
        this.contacts = response.data;
      } catch (err) {
        alert(err);
      }
    },
    btnCreate() {
      this.currentContact = {};
      this.modalContactAdd.show();
    },
    async btnEdit(id) {
      try {
        const response = await axios.get(`/api/contacts/${id}`);
        this.currentContact = response.data;
        this.modalContactEdit.show();
      } catch (err) {
        alert(err);
      }
    },
    async btnDelete(id) {
      if (confirm('Are you sure you want to delete this item?')) {
        try {
          await axios.delete(`/api/contacts/${id}`);
          this.getContacts();
        } catch (err) {
          alert(err);
        }
      }
    },
    async btnDetails(id) {
      try {
        const response = await axios.get(`/api/contacts/${id}`);
        this.currentContact = response.data;
        this.modalContactDetails.show();
      } catch (err) {
        alert(err);
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
  },
}
</script>
<style>
</style>
<template>
<div>
  <div class="content">
    <div class="container-fluid">
      <h1 class="mt-0 pt-0 pb-2">Contacts</h1>
      <hr class="mb-3">
      <Button type="success" @click="btnCreate()">New Contact</Button>
      <table class="_table mt-3">
      <tr>
        <th>ID</th>
        <th>First</th>
        <th>Last</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Birthday</th>
        <th>Actions</th>
      </tr>
      <tr v-for="contact in contacts" :key="contact.id">
        <td>{{ contact.id }}</td>
        <td>{{ contact.firstName }}</td>
        <td>{{ contact.lastName }}</td>
        <td>{{ contact.email }}</td>
        <td>{{ contact.phone }}</td>
        <td>{{ contact.birthday }}</td>
        <td>
          <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-sm btn-secondary" @click="btnDetails(contact.id)">Details</button>
            <button type="button" class="btn btn-sm btn-secondary" @click="btnEdit(contact.id)">Edit</button>
            <button type="button" class="btn btn-sm btn-secondary" @click="btnDelete(contact.id)">Delete</button>
          </div>
        </td>
      </tr>
      </table>

      <!-- Modal Edit -->
      <div id="modalEdit" class="modal" tabindex="-1">
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

      <!-- Modal Add -->
      <div id="modalAdd" class="modal" tabindex="-1">
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

      <!-- Modal Details -->
      <div id="modalDetails" class="modal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
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
                <small>[ addresses go here ]</small>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</template>
