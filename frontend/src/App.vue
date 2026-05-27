<template>
  <div class="container">
    <header class="app-header">
      <h1>Kelola Data Melon </h1>
    </header>

    <div class="grid">
      <div class="card card-form">
        <div class="card-header">
          <h3>Tambah Melon Baru</h3>
        </div>
        <form @submit.prevent="tambahMelon">
          <div class="form-group">
            <label>Nama Melon:</label>
            <input v-model="form.nama" type="text" placeholder="Contoh: Melon Alisha / Melon Inthanon" required />
          </div>

          <div class="form-group">
            <label>Jenis/Warna Daging:</label>
            <input v-model="form.jenis_melon" type="text" placeholder="Contoh: Daging Hijau / Daging Oranye" required />
          </div>
          
          <div class="form-group">
            <label>Stok :</label>
            <input v-model.number="form.stok" type="number" min="0" placeholder="Contoh: 50" required />
          </div>

          <div class="form-group">
            <label>Harga per kg (Rp):</label>
            <input v-model.number="form.harga" type="number" min="0" placeholder="Contoh: 25000" required />
          </div>

          <button type="submit" class="btn-submit">
            <span>Simpan</span>
          </button>
        </form>
      </div>

      <div class="card card-table">
        <div class="card-header table-actions">
          <h3>Daftar Stok Melon</h3>
        </div>
        
        <div class="table-container">
          <table class="melon-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Melon</th>
                <th>Jenis</th>
                <th>Stok</th>
                <th>Harga /kg</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="melon in daftarMelon" :key="melon.id">
                <td class="text-center text-muted">{{ melon.id }}</td>
                <td><span class="melon-badge">{{ melon.nama }}</span></td>
                <td>{{ melon.jenis_melon }}</td>
                <td class="font-semibold">{{ melon.stok }} kg</td>
                <td class="text-success font-semibold">Rp {{ Number(melon.harga).toLocaleString('id-ID') }}</td>
              </tr>
              <tr v-if="daftarMelon.length === 0">
                <td colspan="5" class="empty-row">
                  📭 Belum ada data. Silakan tambah data melon atau pastikan server Laragon menyala.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'App',
  data() {
    return {
      daftarMelon: [],
      form: {
        nama: '',
        jenis_melon: '',
        stok: '',
        harga: ''
      },
      apiUrl: 'http://127.0.0.1:8000/api/melons'
    };
  },
  mounted() {
    this.ambilMelon();
  },
  methods: {
    async ambilMelon() {
      try {
        const response = await axios.get(this.apiUrl);
        this.daftarMelon = response.data;
        console.log("Data sukses dimuat:", response.data);
      } catch (error) {
        console.error("Gagal mengambil data:", error);
        alert("Gagal konek ke backend! Pastikan php artisan serve sudah jalan.");
      }
    },
    async tambahMelon() {
      try {
        const response = await axios.post(this.apiUrl, this.form);
        alert(response.data.message || "Data berhasil disimpan!");
        this.form.nama = '';
        this.form.jenis_melon = '';
        this.form.stok = '';
        this.form.harga = '';
        this.ambilMelon();
      } catch (error) {
        console.error("Gagal mengirim data:", error);
        alert("Gagal menambah data! Periksa status code 422/500 di tab Network.");
      }
    }
  }
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 40px 20px;
  font-family: 'Inter', sans-serif;
  color: #2c3e50;
  background-color: #fdfdfd;
}

.app-header {
  text-align: center;
  margin-bottom: 40px;
}

.app-header h1 {
  font-size: 2.5rem;
  color: #10b981;
  margin-bottom: 8px;
  font-weight: 700;
}

.subtitle {
  color: #6b7280;
  font-size: 1rem;
}

.grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 30px;
}

@media (min-width: 768px) {
  .grid {
    grid-template-columns: 350px 1fr;
  }
}

.card {
  background: #ffffff;
  border: 1px solid #e5e7eb;
  border-radius: 12px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
  overflow: hidden;
}

.card-header {
  padding: 20px;
  border-bottom: 1px solid #e5e7eb;
  background: #f9fafb;
}

.card-header h3 {
  margin: 0;
  font-size: 1.15rem;
  color: #1f2937;
  font-weight: 600;
}

form {
  padding: 20px;
}

.form-group {
  margin-bottom: 18px;
}

.form-group label {
  display: block;
  margin-bottom: 6px;
  font-weight: 500;
  font-size: 0.875rem;
  color: #4b5563;
}

.form-group input {
  width: 100%;
  padding: 10px 14px;
  box-sizing: border-box;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  font-size: 0.95rem;
  transition: all 0.2s ease;
}

.form-group input:focus {
  outline: none;
  border-color: #10b981;
  box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
}

.btn-submit {
  width: 100%;
  background-color: #10b981;
  color: white;
  padding: 12px;
  border: none;
  border-radius: 8px;
  font-size: 0.95rem;
  font-weight: 600;
  cursor: pointer;
}

.btn-submit:hover {
  background-color: #059669;
}

.table-actions {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.btn-refresh {
  background-color: #374151;
  color: white;
  padding: 8px 14px;
  border: none;
  border-radius: 6px;
  font-size: 0.85rem;
  cursor: pointer;
}

.table-container {
  padding: 10px;
  overflow-x: auto;
}

.melon-table {
  width: 100%;
  border-collapse: collapse;
}

.melon-table th, .melon-table td {
  padding: 14px 16px;
  text-align: left;
}

.melon-table th {
  background-color: #f3f4f6;
  color: #4b5563;
  font-weight: 600;
  border-bottom: 2px solid #e5e7eb;
}

.melon-table td {
  border-bottom: 1px solid #edf2f7;
}

.melon-table tbody tr:hover {
  background-color: #f9fafb;
}

.melon-badge {
  background-color: #ecfdf5;
  color: #065f46;
  padding: 4px 10px;
  border-radius: 9999px;
  font-weight: 600;
}

.text-center { text-align: center; }
.text-muted { color: #9ca3af; }
.text-success { color: #10b981; }
.font-semibold { font-weight: 600; }

.empty-row {
  text-align: center;
  color: #6b7280;
  padding: 40px !important;
  font-style: italic;
}
</style>