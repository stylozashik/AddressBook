<template>
    <div class="content">
        <Modal
        :value="getEditContactModalObj.showEditContactModal"
        :mask-closable="false"
		:closable="false"
        width="360">
        <p>Edit Contact Modal</p>
        <!-- Create Contact Form -->
        <!-- <Form  ref="formValidate" :model="formValidate" :rules="ruleValidate" :label-width="90">
            <FormItem label="First Name" prop="firstName">
                <Input v-model="formValidate.firstName" placeholder="Enter the First Name"></Input>
            </FormItem>
            <FormItem label="Last Name" prop="lastName">
                <Input v-model="formValidate.lastName" placeholder="Enter the Last Name"></Input>
            </FormItem>
            <FormItem label="E-mail" prop="mail">
                <Input v-model="formValidate.email" placeholder="Enter their e-mail"></Input>
            </FormItem>
            <FormItem label="Phone" prop="phone">
                <Input v-model="formValidate.phone" placeholder="Enter their phone number"></Input>
            </FormItem>
            <FormItem label="Birthday">
                <Row>
                        <DatePicker format="yyyy/MM/dd" type="date" placeholder="Select date" v-model="formValidate.birthday"></DatePicker>
                </Row>
            </FormItem>
            <FormItem>
                <Button type="primary" @click="handleSubmit('formValidate')">Submit</Button>
                <Button @click="handleReset('formValidate')" style="margin-left: 8px">Reset</Button>
            </FormItem>
        </Form> -->
        </Modal>
    </div>
</template>

<script>
// export default {
//     data() {
// 		return {
//             contactData: {
//                 id: '',
//                 firstName: '',
//                 lastName: '',
//                 email: '',
//                 phone: '',
//                 birthday: '',
//             },
//             formValidate: {
//                 firstName: '',
//                 lastName: '',
//                 email: '',
//                 phone: '',
//                 birthday: '',
//             },
//             ruleValidate: {
//                 firstName: [
//                     { required: true, message: 'The name cannot be empty', trigger: 'blur' }
//                 ],
//                 lastName: [
//                     { required: true, message: 'The name cannot be empty', trigger: 'blur' }
//                 ],
//                 email: [
//                     { required: true, message: 'Mailbox cannot be empty', trigger: 'blur' },
//                     { type: 'email', message: 'Incorrect email format', trigger: 'blur' }
//                 ],
//                 phone: [
//                     { required: true, message: 'Please enter a phone number', trigger: 'change' }
//                 ],
//                 date: [
//                     { required: true, type: 'date', message: 'Please select a birthday', trigger: 'change' }
//                 ],
//             },
//             token: '',
//         }
//     },

//     methods : {
//         async created(id) {
//             this.token = window.Laravel.csrfToken
//             const res = await this.callApi('get', '/app/getContact/{id}',)
//             if(res.status===200){
//                 this.contactLists = res.data
//             } else {
//                 this.swr(error)
//             }
//         },
//         async handleSubmit (formValidate) {
//             if(this.formValidate.firstName.trim()=='') return this.e('First Name is required')
//             if(this.formValidate.lastName.trim()=='') return this.e('Last Name is required')
//             if(this.formValidate.email.trim()=='') return this.e('Email is required')
//             if(this.formValidate.phone.trim()=='') return this.e('Phone is required')
//             // if(this.formValidate.birthday.trim()=='') return this.e('Birthday is required')

// 			const res = await this.callApi('post', '/app/editContact', this.formValidate)
//             console.log(res)
// 			if(res.status===201){
// 				// this.contactLists.unshift(res.formValidate) // need to add this to vue
// 				this.s('Contact has been edited successfully!')
// 				this.formValidate.firstName = ''
//                 this.formValidate.lastName = ''
//                 this.formValidate.email = ''
//                 this.formValidate.phone = ''
//                 this.formValidate.birthday = ''
//                 // need to reload the context/index.vue
// 			} else {
// 				if(res.status==422) {
// 					if (this.res.errors.firstName){
// 						this.i(res.formValidate.errors.firstName[0])
//                     }
//                     if (this.res.errors.lastName){
// 						this.i(res.formValidate.errors.lastName[0])
//                     }
//                     if (this.res.errors.email){
// 						this.i(res.formValidate.errors.email[0])
//                     }
//                     if (this.res.errors.phone){
// 						this.i(res.formValidate.errors.phone[0])
//                     }
//                     if (this.res.errors.birthday){
// 						this.i(res.formValidate.errors.birthday[0])
// 					}
// 				} else {
// 					this.swr()
// 				}
// 			}
//             },
//             handleReset (name) {
//                 this.$refs[name].resetFields();
//             }
//     }
// }
</script>
