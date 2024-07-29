<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    public function index()
    {
        $model = new ProductModel();
        $data['products'] = $model->findAll();

        return view('product/index', $data);
    }

    public function create()
    {
        return view('product/create');
    }

    public function store()
    {
        $model = new ProductModel();

        $file = $this->request->getFile('image');
        if ($file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $imageName);
        } else {
            $imageName = null;
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'image' => $imageName,
        ];

        $model->insert($data);

        return redirect()->to('/products');
    }

    public function edit($id)
    {
        $model = new ProductModel();
        $data['product'] = $model->find($id);

        return view('product/edit', $data);
    }

    public function update($id)
    {
        $model = new ProductModel();

        // Ambil data produk saat ini
        $product = $model->find($id);

        $file = $this->request->getFile('image');
        if ($file->isValid() && !$file->hasMoved()) {
            // Hapus gambar lama jika ada
            if ($product['image'] && file_exists(ROOTPATH . 'public/uploads/' . $product['image'])) {
                unlink(ROOTPATH . 'public/uploads/' . $product['image']);
            }

            // Simpan gambar baru
            $imageName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $imageName);
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $imageName = $this->request->getPost('old_image');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'image' => $imageName,
        ];

        $model->update($id, $data);

        return redirect()->to('/products');
    }

    public function delete($id)
    {
        $model = new ProductModel();
        $product = $model->find($id);

        // Hapus gambar saat menghapus produk
        if ($product['image'] && file_exists(ROOTPATH . 'public/uploads/' . $product['image'])) {
            unlink(ROOTPATH . 'public/uploads/' . $product['image']);
        }

        $model->delete($id);

        return redirect()->to('/products');
    }
}
