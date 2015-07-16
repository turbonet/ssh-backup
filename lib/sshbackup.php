<?php
class sshbackup {
    private $sftp     = null;
    private $date     = '';
    private $config   = array();
    private $illegal  = array();
    private $chartset = '';

    public function __construct($config)
    {
        $this->config = $config;
        $this->date   = date("Ymd");
        $this->sftp   = new Net_SFTP($this->config['ssh_host'], $this->config['ssh_port']);
        if (!$this->sftp->login($this->config['ssh_user'], $this->config['ssh_pass'])) {
            return false;
        }
        $this->osInit();
    }

    private function osInit()
    {
        switch (PHP_OS) {
            case 'WINNT':
                $this->chartset = 'GBK';
                $this->illegal  = array("\\","/",":","*","?",'"',"<",">","|");
                break;
            default:
                $this->chartset = 'UTF-8';
                $this->illegal  = array("/");
        }
    }

    private function download()
    {
        foreach ($this->sftp->nlist($this->config['ssh_path'], true) as $remotefile) {
            if (($remotefile !== '.') && ($remotefile !== '..')) {
                $pathinfo  = pathinfo($remotefile);
                $filename  = str_replace($this->illegal, '_', $pathinfo['basename']);
                $localfile = $pathinfo['dirname'].'/'.mb_convert_encoding($filename, $this->chartset, 'auto');

                $this->sftp->get(
                    $this->config['ssh_path'].$remotefile,
                    $this->buildLocalDir($this->config['dl_path'].$this->date.'/'.$localfile)
                );
            }
        }
    }

    private function buildLocalDir($filepath)
    {
        $dirpath = dirname($filepath);
        if (!is_dir($dirpath)) {
            mkdir($dirpath, '0777', true);
        }
        return $filepath;
    }

    public function run()
    {
        $this->download();
    }
}