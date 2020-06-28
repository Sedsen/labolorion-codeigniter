
	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Produit_model extends CI_Model {
	
		public function __construct()
		{
			parent::__construct();
		}

		public function ajouter_produit($sous_domaine,$nom_produit,$image,$prix=NULL,$description=NULL)
		{
			$data = array('sous_domaine_id' => $sous_domaine,'nom_produit' => $nom_produit, 'image_produit' => $image,'prix_vente' => $prix, 'description' => $description);
			do {
				$this->db->where('sous_domaine_id', $data['sous_domaine_id']);
				$this->db->where('nom_produit', $data['nom_produit']);
				$this->db->from('Produit');
				$num = $this->db->count_all_results();
			}
			while ($num >= 1);
				$resultat = $this->db->insert('Produit', $data);
				if ($resultat)
				{
					return $resultat;
				} else {
					return false;
				}
		}

		function recuperer_liste_produit($nb=3,$debut=0)
		{
			$this->db->select('nom_produit,prix_vente,id')->from('Produit')->order_by('nom_produit','asc');
			return $this->db->limit($nb,$debut)->get()->result();
		}

		public function recuperer_nom_produit($sous_domaine)
		{
			$this->db->select('nom_produit,id,prix_vente,description,image_produit')->from('Produit');
			$this->db->where('sous_domaine_id', $sous_domaine);
			//return $this->db->order_by('nom_produit', 'asc')->get()->result();
			return $this->db->get()->result();
		}

		public function recuperer_image($sous_domaine,$produit)
		{
			$this->db->select('image_produit')->from('Produit');
			$this->db->where('sous_domaine_id', $sous_domaine);
			$this->db->where('nom_produit', $produit);
			return $this->db->get()->result();
		}

		public function supprimer_produit($produit,$sous_domaine)
		{
			$data = array('nom_produit' => rawurldecode($produit), 'sous_domaine_id' => rawurldecode($sous_domaine));
			
			$this->db->delete('Produit',$data);
		}

		function total_produit_enregistrer()
    	{
        	return $this->db->count_all_results('Produit');
    	}

    	 public function recuperer_sous_domaine($produit)
    	{
        	$this->db->select('sous_domaine_id')->from('Produit');
        	$this->db->where('nom_produit', $produit);
        	return $this->db->get()->result();
    	}

    	public function modifier_produit($id,$sous_domaine_id,$nom_produit,$image_produit,$prix,$description)
    	{
    		$data = array('sous_domaine_id' => $sous_domaine_id,'nom_produit' => $nom_produit,'image_produit' => $image_produit,'prix_vente' => $prix,'description' => $description);
    		$this->db->where('id', $id);
        	return $this->db->update('Produit', $data);
    	}

    	public function total_produit_sous_domaine($sous_domaine)
    	{
    		$this->db->where("sous_domaine_id",$sous_domaine);
    		return $this->db->count_all_results('Produit');
    	}

    	function liste_produit($sous_domaine,$nb=3,$debut=0)
		{
			$this->db->select('nom_produit,id')->from('Produit')->where('sous_domaine_id',$sous_domaine)->order_by('nom_produit','asc');
			return $this->db->limit($nb,$debut)->get()->result();
		}

		function recuperer_detail_produit($id)
		{
			$this->db->select('nom_produit,id,prix_vente,description,image_produit,sous_domaine_id')->from('Produit');
			$this->db->where('id',$id);
			return $this->db->get()->result();
		}

		function rechercher_produit($recherche)
		{
			
			$this->db->like('nom_produit', $recherche);
			$this->db->or_like('sous_domaine_id', $recherche);	
			$this->db->or_like('description', $recherche);
			$this->db->select('nom_produit')->from('Produit');
			if ($this->db->count_all_results() == 0) {
				return NULL;
			} else {
				$this->db->like('nom_produit', $recherche);
				$this->db->or_like('sous_domaine_id', $recherche);	
				$this->db->or_like('description', $recherche);
				$this->db->select('nom_produit,id,description');
				return $this->db->get('Produit')->result();
			}
			
		}


	}
	
	/* End of file produit_model.php */
	/* Location: ./application/models/produit_model.php */



?>