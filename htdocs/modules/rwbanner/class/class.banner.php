<?php
//  ------------------------------------------------------------------------ //
//                                  RW-Banner                                //
//                    Copyright (c) 2006 BrInfo                              //
//                     <http://www.brinfo.com.br>                            //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------- //
// Author: Rodrigo Pereira Lima (BrInfo - Soluções Web)                      //
// Site: http://www.brinfo.com.br                                            //
// Project: RW-Banner                                                        //
// Descrição: Sistema de gerenciamento de mídias publicitárias               //
// ------------------------------------------------------------------------- //

$dirname         = basename(dirname(dirname(__FILE__)));

include_once XOOPS_ROOT_PATH."/modules/".$dirname ."/include/functions.php";

$rwbannerConfigs = rwbanner_getModuleConfig();

define("_RWBANNER_DIRIMAGES", $rwbannerConfigs['dir_images']);

//Classe para gerenciamento dos banners
class RWbanners
{
    public $db;
    public $codigo;
    public $categoria;
    public $titulo;
    public $texto;
    public $url;
    public $grafico;
    public $usarhtml;
    public $htmlcode;
    public $showimg;
    public $exibicoes;
    public $maxexib;
    public $clicks;
    public $maxclick;
    public $data;
    public $periodo;
    public $status;
    public $target;
    public $idcliente;
    public $errormsg;
    public $larg;
    public $alt;
    public $obs;

    //Construtor
    public function __construct($dados=null, $id = null)
    {
        if ($dados == null && $id != null) {
            $this->db = &XoopsDatabaseFactory::getDatabaseConnection();
            $sql = 'SELECT * FROM '.$this->db->prefix('rw_banner').' WHERE codigo='.$id;
            $query = $this->db->query($sql);
            $row = $this->db->fetchArray($query);

            $this->codigo = $row['codigo'];
            $this->categoria = $row['categoria'];
            $this->titulo = $row['titulo'];
            $this->texto = $row['texto'];
            $this->url = $row['url'];
            $this->grafico = $row['grafico'];
            $this->usarhtml = $row['usarhtml'];
            $this->htmlcode = $row['htmlcode'];
            $this->showimg = $row['showimg'];
            $this->exibicoes = $row['exibicoes'];
            $this->maxexib = $row['maxexib'];
            $this->clicks = $row['clicks'];
            $this->maxclick = $row['maxclick'];
            $this->data = $row['data'];
            $this->periodo = $row['periodo'];
            $this->status = $row['status'];
            $this->target = $row['target'];
            $this->idcliente = $row['idcliente'];
            $this->larg = $this->setLargura();
            $this->alt = $this->setAltura();
            $this->obs = $row['obs'];
        } elseif ($dados != null) {
            $this->codigo = (isset($dados['codigo']))?$dados['codigo']:'';
            $this->categoria = (isset($dados['categoria']))?$dados['categoria']:'';
            $this->titulo = (isset($dados['titulo']))?$dados['titulo']:'';
            $this->texto = (isset($dados['texto']))?$dados['texto']:'';
            $this->url = (isset($dados['url']))?$dados['url']:'';
            $this->grafico = (isset($dados['grafico']))?$dados['grafico']:'';
            $this->usarhtml = (isset($dados['usarhtml']))?$dados['usarhtml']:'';
            $this->htmlcode = (isset($dados['htmlcode']))?$dados['htmlcode']:'';
            $this->showimg = (isset($dados['showimg']))?$dados['showimg']:'';
            $this->exibicoes = (isset($dados['exibicoes']))?$dados['exibicoes']:'';
            $this->maxexib = (isset($dados['maxexib']))?$dados['maxexib']:'';
            $this->clicks = (isset($dados['clicks']))?$dados['clicks']:'';
            $this->maxclick = (isset($dados['maxclick']))?$dados['maxclick']:'';
            $this->data = (isset($dados['data']))?$dados['data']:'';
            $this->periodo = (isset($dados['periodo']))?$dados['periodo']:'';
            $this->status = (isset($dados['status']))?$dados['status']:$this->status;
            $this->target = (isset($dados['target']))?$dados['target']:'';
            $this->idcliente = (isset($dados['idcliente']))?$dados['idcliente']:'';
            $this->larg = (isset($dados['larg']))?$dados['larg']:'';
            $this->alt = (isset($dados['alt']))?$dados['alt']:'';
            $this->obs = (isset($dados['obs']))?$dados['obs']:'';
        } else {
            $this->codigo = '';
            $this->categoria = '';
            $this->titulo = '';
            $this->texto = '';
            $this->url = '';
            $this->grafico = '';
            $this->usarhtml = '';
            $this->htmlcode = '';
            $this->showimg = '';
            $this->exibicoes = '';
            $this->maxexib = '';
            $this->clicks = '';
            $this->maxclick = '';
            $this->data = '';
            $this->periodo = '';
            $this->status = '';
            $this->target = '';
            $this->idcliente = '';
            $this->larg = '';
            $this->alt = '';
            $this->obs = '';
        }
    }

    // Métodos get e set de todos os atributos
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }
    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTexto($texto)
    {
        $this->texto = $texto;
    }
    public function getTexto()
    {
        return $this->texto;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }
    public function getUrl()
    {
        return $this->url;
    }

    public function setGrafico($grafico)
    {
        $this->grafico = $grafico;
    }
    public function getGrafico()
    {
        return $this->grafico;
    }

    public function setUsarhtml($usarhtml)
    {
        $this->usarhtml = $usarhtml;
    }
    public function getUsarhtml()
    {
        return $this->usarhtml;
    }

    public function setHtmlcode($htmlcode)
    {
        $this->htmlcode = $htmlcode;
    }
    public function getHtmlcode()
    {
        return $this->htmlcode;
    }

    public function setShowimg($showimg)
    {
        $this->showimg = $showimg;
    }
    public function getShowimg()
    {
        return $this->showimg;
    }

    public function setExibicoes($exibicoes)
    {
        $this->exibicoes = $exibicoes;
    }
    public function getExibicoes()
    {
        return $this->exibicoes;
    }

    public function setMaxexib($maxexib)
    {
        $this->maxexib = $maxexib;
    }
    public function getMaxexib()
    {
        return $this->maxexib;
    }

    public function setClicks($clicks)
    {
        $this->clicks = $clicks;
    }
    public function getClicks()
    {
        return $this->clicks;
    }

    public function setMaxclick($maxclick)
    {
        $this->maxclick = $maxclick;
    }
    public function getMaxclick()
    {
        return $this->maxclick;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
    public function getData()
    {
        return $this->data;
    }

    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;
    }
    public function getPeriodo()
    {
        return $this->periodo;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function setTarget($target)
    {
        $this->target = $target;
    }
    public function getTarget()
    {
        return $this->target;
    }

    public function setIdcliente($idcliente)
    {
        $this->idcliente = $idcliente;
    }
    public function getIdcliente()
    {
        return $this->idcliente;
    }

    public function setObs($obs)
    {
        $this->obs = $obs;
    }
    public function getObs()
    {
        return $this->obs;
    }

    public function setError($error)
    {
        $this->errormsg = $error;
    }
    public function getError()
    {
        return $this->errormsg;
    }
    //fim métodos set e get dos atributos

    public function clearDb()
    {
        $this->db = null;
    }

    //Insere um novo banner no banco de dados
    public function grava($flag=null)
    {
        $this->db = &XoopsDatabaseFactory::getDatabaseConnection();
        $sts = ($flag != null)?$flag:1;
        $sql = 'INSERT INTO '.$this->db->prefix('rw_banner').' (codigo, categoria, titulo, texto, url, grafico, usarhtml, htmlcode, showimg, exibicoes, maxexib, clicks, maxclick, data, periodo, status, target, idcliente, obs) VALUES ("'.$this->codigo.'", "'.$this->categoria.'", "'.$this->titulo.'", \''.$this->texto.'\', "'.$this->url.'", "'.$this->grafico.'", "'.$this->usarhtml.'", \''.$this->htmlcode.'\', "'.$this->showimg.'", \''.$this->exibicoes.'\', \''.$this->maxexib.'\', "'.$this->clicks.'", \''.$this->maxclick.'\', "'.date('Y-m-d').'", "'.$this->periodo.'", "'.$sts.'", "'.$this->target.'", "'.$this->idcliente.'", "'.$this->obs.'")';
        if ($query = $this->db->queryF($sql)) {
            return true;
        } else {
            $this->setError($this->db->error());

            return false;
        }
    }

    //Edita o banner instanciado e salva as alterações no banco de dados
    public function edita()
    {
        $this->db = &XoopsDatabaseFactory::getDatabaseConnection();
        $myts =& MyTextSanitizer::getInstance();
        $sql = 'UPDATE '.$this->db->prefix('rw_banner').' SET categoria="'.$this->categoria.'", titulo="'.$this->titulo.'", texto="'.$this->texto.'", url="'.$this->url.'", grafico="'.$this->grafico.'", usarhtml="'.$this->usarhtml.'", htmlcode=\''.$this->htmlcode.'\', showimg="'.$this->showimg.'", exibicoes="'.$this->exibicoes.'", maxexib="'.$this->maxexib.'", clicks="'.$this->clicks.'", maxclick="'.$this->maxclick.'", periodo="'.$this->periodo.'", status="'.$this->status.'", target="'.$this->target.'", idcliente="'.$this->idcliente.'" WHERE codigo= '.$this->codigo;
        if ($query = $this->db->queryF($sql)) {
            return true;
        } else {
            $this->setError($this->db->error());

            return false;
        }
    }

    //Exclui o banner instanciado do banco de dados
    public function exclui()
    {
        $this->db = &XoopsDatabaseFactory::getDatabaseConnection();
        $sql = 'DELETE FROM '.$this->db->prefix('rw_banner').' WHERE codigo= '.$this->codigo;
        if ($query = $this->db->queryF($sql)) {
            return true;
        } else {
            $this->setError($this->db->error());

            return false;
        }
    }

    //Retorna um array associativo de todos os banners encontrados de acordo com os parâmetros.
    public function getBanners($admin = false, $order = null, $categ = null, $limit = null, $start = 0)
    {
        $this->db = &XoopsDatabaseFactory::getDatabaseConnection();
        $extra = ($categ != null)?' WHERE categoria='.$categ:'';
        $extra .= (!$admin && $categ != null)?' and status=1':((!$admin && $categ == null)?' WHERE status=1':'');
        $extra .= ($order != null)?' '.$order:'';
        $extra .= ($limit != null)?' LIMIT '.$start.','.$limit:'';
        $sql = 'SELECT codigo FROM '.$this->db->prefix('rw_banner').$extra;
        $query = $this->db->query($sql);
        $banners = array();
        while (list($id) = $this->db->fetchRow($query)) {
            $banner = new RWbanners(null, $id);
            unset($banner->db);
            unset($banner->errormsg);
            $banners[] =& $banner;
            unset($banner);
        }

        return $banners;
    }

    //Retorna o nome da categoria do banner
    public function getBannnerCategName()
    {
        $this->db = &XoopsDatabaseFactory::getDatabaseConnection();
        $sql = 'SELECT titulo FROM '.$this->db->prefix('rw_categorias').' WHERE cod='.$this->categoria;
        $query = $this->db->query($sql);
        list($nome) = $this->db->fetchRow($query);

        return $nome;
    }

    //Retorna o nome do cliente do banner
    public function getBannnerClientName()
    {
        $this->db = &XoopsDatabaseFactory::getDatabaseConnection();
        $sql = 'SELECT uname FROM '.$this->db->prefix('users').' WHERE uid='.$this->idcliente;
        $query = $this->db->query($sql);
        list($nome) = $this->db->fetchRow($query);

        return $nome;
    }

    //Retorna a quantidade de registros encontrados de acordo com os parâmetros
    public function getRowNum($categ=null, $id=null)
    {
        $this->db = &XoopsDatabaseFactory::getDatabaseConnection();
        $extra = ($categ != null)?' and categoria='.$categ:'';
        $extra .= ($id != null)?' and status!=2 and idcliente='.$id:'';
        $sql = 'SELECT codigo FROM '.$this->db->prefix('rw_banner').' WHERE 1=1 '.$extra;
        $query = $this->db->query($sql);
        $total = $this->db->getRowsNum($query);

        return $total;
    }

    //Recupera a largura e altura da categoria correspondente ao banner instanciado
    public function setLargura()
    {
        $this->db = &XoopsDatabaseFactory::getDatabaseConnection();
        $sql = 'SELECT larg FROM '.$this->db->prefix('rw_categorias').' WHERE cod='.$this->categoria;
        $query = $this->db->query($sql);
        list($larg) = $this->db->fetchRow($query);

        return $larg;
    }
    public function getLargura()
    {
        return $this->larg;
    }

    public function setAltura()
    {
        $this->db = &XoopsDatabaseFactory::getDatabaseConnection();
        $sql = 'SELECT alt FROM '.$this->db->prefix('rw_categorias').' WHERE cod='.$this->getCategoria();
        $query = $this->db->query($sql);
        list($alt) = $this->db->fetchRow($query);

        return $alt;
    }
    public function getAltura()
    {
        return $this->alt;
    }

    public function showBanner($categ=0, $qtde=1, $cols=1, $align='center')
    {
        $cat = ($categ != 0)?$categ:null;
        $arr = $this->getBanners(false, 'ORDER BY RAND()', $cat, $qtde);
        $cont = 0;
        $showban = '<table border="0" cellpadding="0" cellspacing="5"><tr>';
        for ($i = 0; $i <= count($arr)-1; $i++) {
            $arr[$i]->incHits();
            $cont++;
            if ($arr[$i]->getUsarhtml() == 1) {
                $bannerobject = '<div align="'.$align.'">';
                $bannerobject .= $arr[$i]->getHtmlCode();
                $bannerobject .= '</div>';
                $bannerobject .= (count($arr) > 1 && $cols <= 1)?'<br />':'';
            } else {
                if ($arr[$i]->getUrl() == '' || $arr[$i]->getUrl() == '#') {
                    $bannerobject = '<div align="'.$align.'">';
                } else {
                    $bannerobject = '<div align="'.$align.'"><a href="'.$xoopsModule->dirname() .'/conta_click.php?id='.$arr[$i]->getCodigo().'" target="'.$arr[$i]->getTarget().'">';
                }
                if (stristr($arr[$i]->getGrafico(), '.swf')) {
                    $arq = explode('/', $arr[$i]->getGrafico());
                    $grafico1 = _RWBANNER_DIRIMAGES.'/'.$arq[count($arq)-1];
                    include_once(dirname(dirname(__FILE__)) .'/class/FlashHeader.php');
                    $f = new FlashHeader($grafico1);
                    $result = $f->getimagesize();
                    $fps = ($result['frameRate']);
                    $bannerobject .=
            '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="'.$arr[$i]->getLargura().'" height="'.$arr[$i]->getAltura().'">'
            .'<param name=movie value="'.dirname(dirname(__FILE__)) .'/images/rwbanner.swf">'
            .'<param name=quality value=high>'
            .'<PARAM NAME=FlashVars VALUE="alt='.$arr[$i]->getAltura().'&larg='.$arr[$i]->getLargura().'&fps='.$fps.'&banner='.$arr[$i]->getGrafico().'&id='.$arr[$i]->getCodigo().'&url='.dirname(dirname(__FILE__)) .'&target='.$arr[$i]->getTarget().'">'
            .'<embed src="'.dirname(dirname(__FILE__)) .'/images/rwbanner.swf" FlashVars="alt='.$arr[$i]->getAltura().'&larg='.$arr[$i]->getLargura().'&fps='.$fps.'&banner='.$arr[$i]->getGrafico().'&id='.$arr[$i]->getCodigo().'&url='.dirname(dirname(__FILE__)) .'&target='.$arr[$i]->getTarget().'" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"; type="application/x-shockwave-flash" width="'.$arr[$i]->getLargura().'" height="'.$arr[$i]->getAltura().'">'
            .'</embed>'
            .'</object></div>';
                } else {
                    if ($arr[$i]->getShowimg() == 1) {
                        $bannerobject .= '<img style="border:0;" src="'.$arr[$i]->getGrafico().'" alt="" width="'.$arr[$i]->getLargura().'" height="'.$arr[$i]->getAltura().'" border="0" />';
                    } else {
                        $bannerobject .= '<p style="font-weight:normal; text-align:justify;"><span style="text-align:center; font-weight:bold;"<center>'.$arr[$i]->getTitulo().'</center></span><br />'.$arr[$i]->gettexto().'</p>';
                    }
                }
                $bannerobject .= '</a></div>';
                $bannerobject .= (count($arr) > 1 && $cols <= 1)?'<br />':'';
            }
            if ($cols > 0 && $qtde >0) {
                $width = round($cols/$qtde);
            } else {
                $width = '100%';
            }
            $showban .= '<td width="'.$width.'">'.$bannerobject.'</td>';
            if ($cont == $cols) {
                $showban .= '</tr><tr>';
                $cont = 0;
            }
        }
        $showban .= '</tr></table>';

        return $showban;
    }

    public function show1Banner($id=0, $align='center')
    {
        $ban = new RWbanners(null, $id);
        $showban = '<table border="0" cellpadding="0" cellspacing="5"><tr>';
        if ($ban->getUsarhtml() == 1) {
            $bannerobject = '<div align="'.$align.'">';
            $bannerobject .= $ban->getHtmlCode();
            $bannerobject .= '</div>';
        } else {
            if ($ban->getUrl() == '' || $ban->getUrl() == '#') {
                $bannerobject = '<div align="'.$align.'">';
            } else {
                $bannerobject = '<div align="'.$align.'"><a href="'.$xoopsModule->dirname() .'/conta_click.php?id='.$ban->getCodigo().'" target="'.$ban->getTarget().'">';
            }
            if (stristr($ban->getGrafico(), '.swf')) {
                $arq = explode('/', $ban->getGrafico());
                $grafico1 = _RWBANNER_DIRIMAGES.'/'.$arq[count($arq)-1];
                include_once(dirname(dirname(__FILE__)) .'/class/FlashHeader.php');
                $f = new FlashHeader($grafico1);
                $result = $f->getimagesize();
                $fps = ($result['frameRate']);
                $bannerobject .=
            '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="'.$ban->getLargura().'" height="'.$ban->getAltura().'">'
            .'<param name=movie value="'.dirname(dirname(__FILE__)) .'/images/rwbanner.swf">'
            .'<param name=quality value=high>'
            .'<PARAM NAME=FlashVars VALUE="alt='.$ban->getAltura().'&larg='.$ban->getLargura().'&fps='.$fps.'&banner='.$ban->getGrafico().'&id='.$ban->getCodigo().'&url='.dirname(dirname(__FILE__)) .'&target='.$ban->getTarget().'">'
            .'<embed src="'.dirname(dirname(__FILE__)) .'/images/rwbanner.swf" FlashVars="alt='.$ban->getAltura().'&larg='.$ban->getLargura().'&fps='.$fps.'&banner='.$ban->getGrafico().'&id='.$ban->getCodigo().'&url='.dirname(dirname(__FILE__)) .'&target='.$ban->getTarget().'" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"; type="application/x-shockwave-flash" width="'.$ban->getLargura().'" height="'.$ban->getAltura().'">'
            .'</embed>'
            .'</object>';
            } else {
                if ($ban->getShowimg() == 1) {
                    $bannerobject .= '<img style="border:0;" src="'.$ban->getGrafico().'" alt="" width="'.$ban->getLargura().'" height="'.$ban->getAltura().'" />';
                } else {
                    $bannerobject .= '<p style="font-weight:normal; text-align:justify;"><span style="text-align:center; font-weight:bold;"<center>'.$ban->getTitulo().'</center></span><br />'.$ban->gettexto().'</p>';
                }
            }
            $bannerobject .= '</a></div>';
        }
        $showban .= '<td>'.$bannerobject.'</td>';
        $ban->incHits();
        $showban .= '</tr></table>';

        return $showban;
    }

    //Incrementa o número de exibições do banner e caso o limite de exibições, cliques ou período seja atingido desativa o banner
    public function incHits()
    {
        $hits = $this->getExibicoes();
        $hits++;
        $data = $this->getData();
        $periodo = $this->getPeriodo();
        $maxdata = somaData($data, $periodo);
        if (($this->getMaxexib() == 0 || $hits < $this->getMaxexib()) && ($this->getMaxclick() == 0 || $this->getClicks() < $this->getMaxclick()) && ($this->getPeriodo() == 0 || date('Y-m-d') <= $maxdata)) {
            $this->setExibicoes($hits);
        } elseif ($hits >= $this->getMaxexib()) {
            $this->setStatus(0);
        } elseif ($this->getClicks() >= $this->getMaxclick()) {
            $this->setStatus(0);
        } elseif (date('Y-m-d') > $maxdata) {
            $this->setStatus(0);
        }
        $this->edita();
    }

    //Incrementa o número de clicks do banner
    public function incClicks()
    {
        $clicks = $this->getClicks();
        $clicks++;
        if ($this->getMaxclick() == 0 || $this->getClicks() < $this->getMaxclick()) {
            $this->setClicks($clicks);
        } elseif ($this->getClicks() >= $this->getMaxclick()) {
            $this->setStatus(0);
        }
        $this->edita();
    }

    //Altera o status do banner. Se o parametro sts for passado altera o status atual pelo sts senão ele altera o status para o inverso do status atual Ex.: Status = 0; Novo Status = 1;
    public function mudaStatus($sts=null)
    {
        $this->status = (isset($sts))?$sts:($this->status == 1)?0:1;

        return $this->edita();
    }

    //Retorna todos os banners de um determinado cliente
    public function getAllByClient($uid, $order = null, $categ = null, $limit = null, $start = 0)
    {
        $this->db = &XoopsDatabaseFactory::getDatabaseConnection();
        $extra = ($categ != null)?' and categoria='.$categ:'';
        $extra .= ($order != null)?' '.$order:'';
        $extra .= ($limit != null)?' LIMIT '.$start.','.$limit:'';
        $sql = 'SELECT codigo FROM '.$this->db->prefix('rw_banner').' WHERE idcliente='.$uid.' and status!=2'.$extra;
        $query = $this->db->query($sql);
        $banners = array();
        while (list($id) = $this->db->fetchRow($query)) {
            $banner = new RWbanners(null, $id);
            unset($banner->db);
            unset($banner->errormsg);
            $banners[] =& $banner;
            unset($banner);
        }

        return $banners;
    }
}
