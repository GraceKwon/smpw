@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    <table class="table table-register">
        <tbody>
        <tr>
            <th>
                <label class="label">보내는사람</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select 
                        class="custom-select"
                        v-model="form.AdminID">
                        <option value="{{ session('auth.AdminID') }}" 
                            selected>{{ session('auth.AdminName') }}</option>
                    </select>
                </div>
            </td>
            <th>
                <label class="label">수신대상선택</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <input type="text"
                        class="form-control mr-1"
                        v-model="searchAdmin"
                        placeholder="수신대상 검색">
                    <select 
                        id="ReceiveAdminID"
                        style="width: 200px"
                        class="custom-select"
                        :class="{'is-invalid': validation.ReceiveAdminID}"
                        v-model="form.ReceiveAdminID">
                        <option value="">선택</option>
                        <option v-for="(receiveAdmin, index) in receiveAdmins"
                            :value="receiveAdmin.AdminID">@{{receiveAdmin.AdminName }}</option>
                      
                    </select>
                    <div class="invalid-feedback" v-if="validation.Title">
                        @{{ validation.ReceiveAdminID[0] }}
                    </div> 
                    
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">제목</label>
            </th>
            <td colspan="3">
                <input type="text" 
                    class="form-control"
                    :class="{'is-invalid': validation.Title}"
                    v-model="form.Title" 
                    placeholder="제목을 입력해 주세요">
                <div class="invalid-feedback" v-if="validation.Title">
                    @{{ validation.Title[0] }}
                </div>            
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">첨부파일</label>
            </th>
            <td colspan="3">    
                <div id="drop-zone">
                    <div v-for="(file, index) in form.Files">
                        <span style="font-size: 15px; color:#4b5aaa">@{{ file.name }}</span> 
                        <i @click="delFile(index)" class="fas fa-times-circle pointer"></i>
                    </div>
                    <div class="here" v-if="form.Files.length === 0">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <br />
                        여기에 파일을 올려 놓으세요
                    </div>
                </div>
                <button type="button" class="btn-primary mt-2" @click="selFile">파일선택</button>

                <input type="file" class="hide" ref="inputFile" multiple>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">메시지 입력</label>
            </th>
            <td colspan="3">
                <div 
                    class="invalid-feedback" 
                    v-if="validation.Contents" 
                    style="display: block">
                    @{{ validation.Contents[0] }}
                </div>
                <textarea 
                    v-model="form.Contents" 
                    class="form-control" 
                    name="notice-board" 
                    id="notice-board"></textarea>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="btn-flex-area justify-content-end">
        <button 
            type="button" 
            class="btn btn-secondary"
            onclick="location.href='/sent'">취소</button>
        <button 
            type="button" 
            class="btn btn-primary" 
            @click="trySubmit">보내기</button>
    </div> <!-- /.register-btn-area -->
</section>
@endsection

@section('popup')
@endsection

@section('script')
<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/js/axios.js"></script>
<script>
    var app = new Vue({
        el:'#wrapper-body',
        data:{
            receiveAdmins: [],
            searchAdmin: '',
            form: {
                AdminID: "{{ session('auth.AdminID') }}",
                ReceiveAdminID: '',
                Title: "",
                Contents: "",
                Files: []
            },
            validation: {
                Title: false,
                Contents: false
            }
        },
        computed: {
            fileSize: function () {
                var size = 0
                for (let index = 0; index < this.form.Files .length; index++) {
                    size += this.form.Files [index].size;
                }
                return size
            }
        },
        created: function () {
            this.getReceiveAdmins()
        },
        watch: {
            searchAdmin: function () {
                this.getReceiveAdmins()
            }
        },
        mounted: function () {
            this.$nextTick(function () {
                CKEDITOR.replace( 'notice-board' ,{
                    enterMode: CKEDITOR.ENTER_BR
                });

                var drop = document.getElementById('drop-zone');
                drop.ondragover = function(e) {
                    e.preventDefault();
                    drop.style.backgroundColor = '#cac7c7'
                };
                drop.ondragleave = function(e) {
                    drop.style.backgroundColor = '#fafafa'
                }
                drop.ondrop = function(e) {
                    e.preventDefault();
                    drop.style.backgroundColor = '#fafafa'
                    var data = e.dataTransfer;
                    if (data.items) {
                        for (var i = 0; i < data.items.length; i++) {
                            if (data.items[i].kind == "file") {
                                var file = data.items[i].getAsFile();
                                console.log(file)
                                app.pushFile(file)    
                            }
                        }
                    } else {
                        for (var i = 0; i < data.files.length; i++) {
                            alert(data.files[i].name);
                        }
                    }
                };

                var file = app.$refs.inputFile;
                file.onchange = function () {
                    var fileList = file.files;
                    for (var i = 0; i < fileList.length; i++) {
                        app.pushFile(fileList[i])         
                    }
                };
            
            })
        },
        methods:{
            getReceiveAdmins: function() {
                this.form.ReceiveAdminID = ''
                axios.get('/getReceiveAdminList?name=' + this.searchAdmin)
                .then(function (response) {
                    this.receiveAdmins = response.data
                    if (this.receiveAdmins.length === 1) this.form.ReceiveAdminID = this.receiveAdmins[0].AdminID
                }.bind(this))
                .catch(function (error) {
                    console.log(error.response)
                })
            },
            pushFile: function(file) {
                if (this.fileSize >= 20000000) {
                    alert('용량이 초과 되었습니다.')
                    return false
                }
                if (this.form.Files.length >= 20) {
                    alert('더이상 등록할 수 없습니다.')
                    return false
                }
                for (let index = 0; index < this.form.Files.length; index++) {
                    if (this.form.Files[index].name == file.name) {
                        alert('이미 등록된 파일입니다.')
                        return false                                            
                    }
                }
                this.form.Files.push(file)
            },
            delFile: function(index) {
                this.form.Files.splice(index, 1)
            },
            selFile: function() {
                this.$refs.inputFile.click()
            },
            trySubmit: function() {
                var formData = new FormData();
                formData.append('AdminID', this.form.AdminID);
                formData.append('ReceiveAdminID', this.form.ReceiveAdminID);
                formData.append('Title', this.form.Title);
                formData.append('Contents', CKEDITOR.instances['notice-board'].getData());
                for (var i = 0; i < this.form.Files.length; i++) {
                    formData.append('Files[]', this.form.Files[i]);
                    console.log(this.form.Files[i])
                }

                axios.post('/sent/0/form', formData)
                .then(function (response) {
                    console.log(response);
                    location.href = '/sent'
                })
                .catch(function (error) {
                    console.log(error.response);
                    if (error.response.status === 422) {
                        console.log(error.response);
                        this.validation = error.response.data.errors
                    }
                }.bind(this));
            }
        }
    })
</script>
@endsection
