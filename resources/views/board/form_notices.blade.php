@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    <table class="table table-register">
        <tbody>
        <tr>
            <th>
                <label class="label">지역선택</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select">
                        <option selected="">선택</option>
                        <option>option</option>
                    </select>
                </div>
            </td>
            <th>
                <label class="label">열람대상선택</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select">
                        <option selected="">선택</option>
                        <option>option</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">제목</label>
            </th>
            <td colspan="3">
                <input type="text" class="form-control" id="register02" placeholder="제목을 입력해 주세요">
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
                <input type="file" id="input-file" multiple>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">내용</label>
            </th>
            <td colspan="3">
                <textarea v-model="form.Contents" class="form-control" name="notice-board" id="notice-board"></textarea>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="btn-flex-area justify-content-end">
        <button type="button" class="btn btn-secondary">취소</button>
        <button type="button" class="btn btn-primary" @click="trySubmit">저장</button>
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
            form: {
                MetroID: "",
                ReceiveGroupID: "",
                Title: "",
                Contents: "asdf",
                Files: []
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
                                app.$data.form.Files.push(file)
                            }
                        }
                    } else {
                        for (var i = 0; i < data.files.length; i++) {
                        alert(data.files[i].name);
                        }
                    }
                };

                var file = document.querySelector('#input-file');
                file.onchange = function () {
                    var fileList = file.files;
                    for (var i = 0; i < fileList.length; i++) {
                        app.$data.form.Files.push(fileList[i])              
                    }
                };
            
            })
        },
        methods:{
            delFile: function(index) {
                this.form.Files.splice(index, 1)
            },
            trySubmit: function() {
                var formData = new FormData();
                formData.append('MetroID', this.form.MetroID);
                formData.append('ReceiveGroupID', this.form.ReceiveGroupID);
                formData.append('Title', this.form.Title);
                formData.append('Contents', CKEDITOR.instances['notice-board'].getData());
                for (var i = 0; i < this.form.Files.length; i++) {
                    formData.append('Files[]', this.form.Files[i]);
                    console.log(this.form.Files[i])
                }

                axios.post('/notices/0/form', formData)
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    })


    
</script>
@endsection
