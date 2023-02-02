@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    <table class="table table-register">
        <tbody>
        <tr>
            <th>
                <label class="label">{{ __('msg.CITY') }}</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select"
                            :class="{'is-invalid': validation.MetroID}"
                            id="MetroID"
                            name="MetroID"
                            @if(session('auth.MetroID')) disabled @endif
                            v-model="form.MetroID">
                            <option value="">{{ __('msg.ALL') }}</option>
                            @foreach ($MetroList as $Metro)
                                <option value="{{ $Metro->MetroID }}">{{ $Metro->MetroName}}</option>
                            @endforeach
                    </select>
                    <div class="invalid-feedback"
                        v-if="validation.MetroID"
                        v-html="validation.MetroID[0]"></div>
                </div>
            </td>
            <th>
                <label class="label">지역</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select @error('CircuitID') is-invalid @enderror"
                        id="CircuitID"
                        name="CircuitID"
                        @if(session('auth.CircuitID')) disabled @endif
                        v-model="form.CircuitID">
                        <option value="">{{ __('msg.ALL') }}</option>
                        <option v-for="Circuit in CircuitList"
                            :value="Circuit.CircuitID">@{{ Circuit.CircuitName }}</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">{{ __('msg.CHOOSE_RT') }}</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select"
                        :class="{'is-invalid': validation.ReceiveGroupID}"
                        v-model="form.ReceiveGroupID">
                        <option value="">{{ __('msg.SELECT') }}</option>
                        @foreach ($ReceiveGroupList as $ReceiveGroup)
                            <option value="{{ $ReceiveGroup->ID }}">{{ $ReceiveGroup->Item }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"
                        v-if="validation.ReceiveGroupID"
                        v-html="validation.ReceiveGroupID[0]"></div>
                </div>
            </td>
            <th>
                <label class="label">{{ __('msg.SV') }}</label>
            </th>
            <td>
            <div class="inline-responsive">
                <div class="check-group inline-responsive">
                    <div class="custom-control custom-radio">
                        <input type="radio"
                            class="custom-control-input @error('SupportYn') is-invalid @enderror"
                            v-model="form.DisplayYn"
                            id="DisplayY"
                            value="1"
                            name="DisplayYn">
                        <label class="custom-control-label" for="DisplayY">{{ __('msg.MK') }}</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio"
                            class="custom-control-input @error('SupportYn') is-invalid @enderror"
                            v-model="form.DisplayYn"
                            id="DisplayN"
                            value="0"
                            name="DisplayYn">
                        <label class="custom-control-label" for="DisplayN">{{ __('msg.UMK') }}</label>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">{{ __('msg.TITLE') }}</label>
            </th>
            <td colspan="3">
                <input type="text"
                    class="form-control"
                    :class="{'is-invalid': validation.Title}"
                    v-model="form.Title"
                    placeholder="{{ __('msg.INPUT_SUBJECT') }}">
                <div class="invalid-feedback"
                    v-if="validation.Title"
                    v-html="validation.Title[0]">
                </div>
            </td>

        </tr>
        <tr>
            <th>
                <label class="label">{{ __('msg.ATT_FILE') }}</label>
            </th>
            <td colspan="3">
                <div class="progress"
                    v-if="form.Files.length > 0 || OldFiles.length > 0">
                    <div class="progress-bar"
                        role="progressbar"
                        :style="{ width: fileSizeP + '%' }">
                        @{{ fileSizeP }}% @{{ setByte(fileSize) }} (@{{ form.Files.length }}/@{{ maxFileLeng }})
                    </div>
                </div>
                <div id="drop-zone">
                    <div v-for="(file) in OldFiles">
                        <span style="font-size: 15px; color:#4b5aaa"
                            :class="{cancel: form.delFiles.indexOf(file.NoticeFileID) !== -1}"
                            v-html="file.FilePath" ></span>
                        <i @click="delOldFile(file.NoticeFileID)"
                            v-if="form.delFiles.indexOf(file.NoticeFileID) == -1"
                            class="fas fa-times-circle pointer"></i>
                        <i @click="delOldFile(file.NoticeFileID)"
                            v-else
                            class="fas fa-redo-alt pointer"></i>
                    </div>
                    <div v-for="(file, index) in form.Files">
                        <span style="font-size: 15px; color:#4b5aaa">@{{ file.name }}</span>
                        <span style="font-size: 12px; color:#7b7b7b">@{{ setByte(file.size)}}</span>
                        <i @click="delFile(index)" class="fas fa-times-circle pointer"></i>
                    </div>
                    <div class="here" v-if="form.Files.length === 0 && OldFiles.length === 0">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <br />
                        {{ __('msg.PUT_UR_FILE') }}
                    </div>
                </div>

                <button type="button"
                    class="btn-primary mt-2"
                    @click="selFile">{{ __('msg.SF') }}</button>

                <input type="file"
                    class="hide"
                    ref="inputFile" multiple>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">{{ __('msg.CT') }}</label>
            </th>
            <td colspan="3">
                <div class="invalid-feedback"
                    v-if="validation.Contents"
                    v-html="validation.Contents[0]"
                    style="display: block">
                </div>
                <textarea
                    class="form-control"
                    name="notice-board"
                    id="notice-board">{{ $Notice[0]->Contents ?? "" }}</textarea>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="btn-flex-area justify-content-end">
        <button
            type="button"
            class="btn btn-secondary"
            onclick="location.href='/notices'">{{ __('msg.CANCEL') }}</button>
        @if (isset($Notice[0]->NoticeID))
        <button
            type="button"
            class="btn btn-danger"
            @click="tryDelete">삭제</button>
        @endif
        <button
            type="button"
            class="btn btn-primary"
            @click="trySubmit">{{ isset($Notice[0]->NoticeID) ? __('msg.EDIT') : __('msg.SAVE') }}</button>
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
            CircuitList: [],
            OldFiles: {!! $Files !!},
            maxFileSize: 5000000,
            maxFileLeng: 20,
            form: {
                NoticeID: "{{ $Notice[0]->NoticeID ?? 0 }}",
                AdminID: "{{ $Notice[0]->AdminID ?? session('auth.AdminID') }}",
                MetroID: "{{ $Notice[0]->MetroID ?? session('auth.MetroID') }}",
                CircuitID: "{{ $Notice[0]->CircuitID ?? session('auth.CircuitID') }}",
                ReceiveGroupID: "{{ $Notice[0]->ReceiveGroupID ?? "" }}",
                DisplayYn: {{ $Notice[0]->DisplayYn ?? 1 }},
                Title: "{{ $Notice[0]->Title ?? "" }}",
                ReadCnt: {{ $Notice[0]->ReadCnt ?? 0 }},
                Files: [],
                delFiles: []
            },
            validation: {
                MetroID: false,
                ReceiveGroupID: false,
                Title: false,
                Contents: false
            }
        },
        computed: {
            fileSize: function () {
                var size = 0
                for (let index = 0; index < this.form.Files .length; index++) {
                    size += this.form.Files[index].size;
                }
                return size
            },
            fileSizeP: function () {
                return Math.round(this.fileSize / this.maxFileSize * 100)
            }
        },
        watch: {
            'form.MetroID': function () {
                this.CircuitID = '';
                this._getCircuitList();
            },
        },
        mounted: function () {
            this._getCircuitList();
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
            _getCircuitList: function () {
                var params = {
                    params: {
                        MetroID: this.form.MetroID
                    }
                };
                axios.get('/getCircuitList', params)
                    .then(function (response) {
                        this.CircuitList = response.data;
                    }.bind(this))
                    .catch(function (error) {
                    });
            },
            pushFile: function(file) {
                if (this.fileSize + file.size >= this.maxFileSize) {
                    alert(this.setByte(this.maxFileSize) + '{{ __('msg.CANNOT_EXCEED') }}')
                    return false
                }
                if (this.form.Files.length >= this.maxFileLeng) {
                    alert('{{ __('msg.NO_LONGER') }}')
                    return false
                }
                for (let index = 0; index < this.form.Files.length; index++) {
                    if (this.form.Files[index].name == file.name) {
                        alert('{{ __('msg.ALREADY_REGISTER') }}')
                        return false
                    }
                }
                this.form.Files.push(file)
            },
            delFile: function(index) {
                this.form.Files.splice(index, 1)
            },
            delOldFile: function(noticeFileID) {

                if (this.form.delFiles.indexOf(noticeFileID) !== -1) {
                    this.form.delFiles.splice(this.form.delFiles.indexOf(noticeFileID),1);
                } else {
                    if (!confirm('{{ __('msg.WANT_DEL') }}')) return false
                    this.form.delFiles.push(noticeFileID)
                }

            },
            selFile: function() {
                this.$refs.inputFile.click()
            },
            trySubmit: function() {
                var formData = new FormData();
                formData.append('NoticeID', this.form.NoticeID);
                formData.append('AdminID', this.form.AdminID);
                formData.append('MetroID', this.form.MetroID);
                formData.append('CircuitID', this.form.CircuitID);
                formData.append('ReceiveGroupID', this.form.ReceiveGroupID);
                formData.append('DisplayYn', this.form.DisplayYn);
                formData.append('Title', this.form.Title);
                formData.append('ReadCnt', this.form.ReadCnt);
                formData.append('delFiles', this.form.delFiles.join());
                formData.append('Contents', CKEDITOR.instances['notice-board'].getData());
                for (var i = 0; i < this.form.Files.length; i++) {
                    formData.append('Files[]', this.form.Files[i]);
                }

                axios.post('/notices/' + this.form.NoticeID + '/form', formData)
                .then(function (response) {
                    location.href = '/notices'
                })
                .catch(function (error) {
                    console.log(error.response);

                    if (error.response.status === 422) {
                        console.log(error.response);
                        this.validation = error.response.data.errors
                    }
                }.bind(this));
            },
            tryDelete: function () {

                if (!confirm('{{ __('msg.WISH_DELETE') }}')) return false
                axios.post('/notices/' + this.form.NoticeID + '/delete')
                .then(function (response) {
                    alert('{{ __('msg.BEEN_DEL') }}')
                    location.href = '/notices'

                })
                .catch(function (error) {
                    console.log(error.response)
                })
            },
            setByte: function (size) {
                if (size >= 1000000) {
                    return (size / 1000000).toFixed(1) + 'MB'
                }
                if (size >= 1000) {
                    return (size / 1000).toFixed(0) + 'KB'
                }

                return size + 'Byte'
            }
        }
    })
</script>
@endsection
