<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('ProductModel');
        $this->call->helper('url');
    }

    public function before_action()
    {
        if (!$this->session->userdata('authenticated')) {
            redirect('/login');
        }
    }

    public function index()
    {
        $products = $this->ProductModel->order_by('created_at', 'DESC');
        $this->call->view('products/index', [
            'products' => $products,
            'username' => $this->session->userdata('username'),
            'role' => $this->session->userdata('role') ?? 'user',
        ]);
    }

    public function create()
    {
        $this->require_admin();
        $product = ['product_name' => '', 'description' => '', 'price' => '', 'quantity' => ''];
        return $this->save_product($product, 'create');
    }

    public function edit($id)
    {
        $this->require_admin();
        $product = $this->ProductModel->find((int)$id);
        if (!$product) {
            show_404();
        }

        return $this->save_product($product, 'edit', (int)$id);
    }

    public function delete($id)
    {
        $this->require_admin();
        $this->ProductModel->delete((int)$id);
        redirect('/products');
    }

    private function save_product(array $product, string $mode, ?int $id = null)
    {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = [
                'product_name' => trim((string)($_POST['product_name'] ?? '')),
                'description' => trim((string)($_POST['description'] ?? '')),
                'price' => trim((string)($_POST['price'] ?? '')),
                'quantity' => trim((string)($_POST['quantity'] ?? '')),
            ];

            if ($product['product_name'] === '' || $product['description'] === '' ||
                !is_numeric($product['price']) || (float)$product['price'] < 0 ||
                filter_var($product['quantity'], FILTER_VALIDATE_INT) === false || (int)$product['quantity'] < 0) {
                $error = 'Enter a name, description, non-negative price, and whole-number quantity.';
            } else {
                $product['price'] = number_format((float)$product['price'], 2, '.', '');
                $product['quantity'] = (int)$product['quantity'];
                if ($mode === 'edit') {
                    $this->ProductModel->update($id, $product);
                } else {
                    $this->ProductModel->insert($product);
                }
                redirect('/products');
            }
        }

        $this->call->view('products/form', [
            'product' => $product,
            'mode' => $mode,
            'error' => $error,
        ]);
    }

    private function require_admin()
    {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('/products');
        }
    }
}