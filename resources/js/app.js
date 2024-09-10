import './bootstrap';
import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';

// Import plugins
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';

// Register plugins
FilePond.registerPlugin(
    FilePondPluginFileValidateSize,
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview,
    FilePondPluginImageCrop,
    FilePondPluginImageExifOrientation
);

// Ambil CSRF token dari meta tag
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Inisialisasi FilePond untuk elemen input
const inputElement = document.querySelector('input[type="file"]');
const pond = FilePond.create(inputElement);

// Konfigurasi FilePond
pond.setOptions({
    server: {
        process: {
            url: '/fileUpload', // URL untuk mengirim data file
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        },
        revert: {
            url: '/revert',  // URL untuk membatalkan upload
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        },
        fetch: null         // URL untuk mengambil data
    }
});