<?php
/*
 * This file is part of FacturaScripts
 * Copyright (C) 2014  Francesc Pineda Segarra  shawe.ewahs@gmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class dashboard extends fs_controller
{
   public function __construct()
   {
      parent::__construct(__CLASS__, 'Dashboard', 'ventas', FALSE, TRUE);
   }
   
   protected function process()
   {
      /// Guardamos las extensiones
      $extensiones = array(
          array(
              'name' => 'docs.min.css',
              'page_from' => __CLASS__,
              'page_to' => __CLASS__,
              'type' => 'head',
              'text' => '<link href="plugins/dashboard/view/css/docs.min.css" rel="stylesheet" type="text/css" />',
              'params' => ''
          ),
          array(
              'name' => 'carousel.css',
              'page_from' => __CLASS__,
              'page_to' => __CLASS__,
              'type' => 'head',
              'text' => '<link href="plugins/dashboard/view/css/carousel.css" rel="stylesheet" type="text/css" />',
              'params' => ''
          )
      );
      foreach($extensiones as $ext)
      {
         $fsext0 = new fs_extension($ext);
         if( !$fsext0->save() )
         {
            $this->new_error_msg('Imposible guardar los datos de la extensión '.$ext['name'].'.');
         }
      }
      
      // Cambiar este valor si no se va a utilizar nunca el plugin "Presupuestos y pedidos" en ventas
      $this->show_presupuestos_y_pedidos_ventas = TRUE;
      // Cambiar este valor si no se va a utilizar nunca el plugin "Presupuestos y pedidos" en compras
      $this->show_presupuestos_y_pedidos_compras = TRUE;
   }
   
   /* Devuelve el número total de presupuestos de venta realizados */
   public function ventas_num_presupuestos()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `presupuestoscli`");
      return $data;
   }
   
   /* Devuelve el número total de presupuestos de venta aprobados */
   public function ventas_num_presupuestos_aprobados()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `presupuestoscli`
            WHERE status=1");
      return $data;
   }
   
   /* Devuelve el número total de presupuestos de venta sin aprobar */
   public function ventas_num_presupuestos_pendientes()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `presupuestoscli`
            WHERE status=0");
      return $data;
   }
   
   /* Devuelve el número total de presupuestos de venta rechazados */
   public function ventas_num_presupuestos_rechazados()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `presupuestoscli`
            WHERE status=2");
      return $data;
   }

   /* Devuelve el número total de pedidos de venta realizados */
   public function ventas_num_pedidos()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `pedidoscli`");
      return $data;
   }
   
   /* Devuelve el número total de pedidos de venta aprobados */
   public function ventas_num_pedidos_aprobados()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `pedidoscli`
            WHERE status=1");
      return $data;
   }
   
   /* Devuelve el número total de pedidos de venta sin aprobar */
   public function ventas_num_pedidos_pendientes()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `pedidoscli`
            WHERE status=0");
      return $data;
   }
   
   /* Devuelve el número total de pedidos de venta rechazados */
   public function ventas_num_pedidos_rechazados()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `pedidoscli`
            WHERE status=2");
      return $data;
   }
   
   /* Devuelve el número total de albaranes de venta realizados */
   public function ventas_num_albaranes()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `albaranescli`");
      return $data;
   }
   
   /* Devuelve el número total de albaranes de venta hechos */
   public function ventas_num_albaranes_aprobados()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `albaranescli`
            WHERE idfactura IS NOT NULL");
      return $data;
   }
   
   /* Devuelve el número total de albaranes de venta sin aprobar */
   public function ventas_num_albaranes_pendientes()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `albaranescli`
            WHERE idfactura IS NULL");
      return $data;
   }
   
   /* Devuelve el número total de facturas de venta realizadas */
   public function ventas_num_facturas()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `facturascli`");
      return $data;
   }
   
   /* Devuelve el número total de facturas de venta cobradas */
   public function ventas_num_facturas_cobradas()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `facturascli`
            WHERE pagada=TRUE");
      return $data;
   }
   
   /* Devuelve el número total de facturas de venta sin cobrar */
   public function ventas_num_facturas_sin_cobrar()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `facturascli`
            WHERE pagada=FALSE");
      return $data;
   }

   /* Devuelve el número total de pedidos de compra realizados */
   public function compras_num_pedidos()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `pedidosprov`");
      return $data;
   }
   
   /* Devuelve el número total de pedidos de compra aprobados */
   public function compras_num_pedidos_aprobados()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `pedidosprov`
            WHERE idalbaran IS NOT NULL");
      return $data;
   }
   
   /* Devuelve el número total de pedidos de compra sin aprobar */
   public function compras_num_pedidos_pendientes()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `pedidosprov`
            WHERE idalbaran IS NULL");
      return $data;
   }
   
   /* Devuelve el número total de albaranes de compra realizados */
   public function compras_num_albaranes()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `albaranesprov`");
      return $data;
   }
   
   /* Devuelve el número total de albaranes de compra hechos */
   public function compras_num_albaranes_aprobados()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `albaranesprov`
            WHERE idfactura IS NOT NULL");
      return $data;
   }
   
   /* Devuelve el número total de albaranes de compra sin aprobar */
   public function compras_num_albaranes_pendientes()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `albaranesprov`
            WHERE idfactura IS NULL");
      return $data;
   }
   
   /* Devuelve el número total de facturas de compra realizadas */
   public function compras_num_facturas()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `facturasprov`");
      return $data;
   }
   
   /* Devuelve el número total de facturas de compra cobradas */
   public function compras_num_facturas_cobradas()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `facturasprov`
            WHERE pagada=TRUE");
      return $data;
   }
   
   /* Devuelve el número total de facturas de compra sin pagar */
   public function compras_num_facturas_sin_pagar()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codigo)) AS total
            FROM `facturasprov`
            WHERE pagada=FALSE");
      return $data;
   }
   
   public function num_articulos()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(referencia)) AS total
            FROM `articulos`");
      return $data;
   }
   
   public function num_clientes()
   {
      $data = $this->db->select("SELECT COUNT( DISTINCT(codcliente)) AS total
            FROM `clientes`");
      return $data;
   }
   
}
