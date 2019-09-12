<?php
class ModelToolIP2LocationRedirector extends Model {

    /**
     * @param array $data
     * @return array
     */
    public function getRules($data = array()) {
        $results = $this->db->query($this->getRulesSql($data));

        return $results->rows;
    }

    /**
     * @param array $data
     * @return int
     */
    public function getTotalRules($data = array()) {
        $results = $this->db->query($this->getRulesSql($data, true));

        return (int)$results->row['total'];
    }

    public function addRule($data) {
        $columns = array();
		$countries = array();
		$origins = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ip2location_country");

		foreach ($query->rows as $result) {
			$countries[$result['country_code']] = $result['country_name'];
		}

		foreach($data['origins'] as $origin) {
			list($countryCode, $regionName) = explode('-', $origin);

			$origins[] = array(
				'code'		=> $countryCode,
				'name'		=> (isset($countries[$countryCode])) ? $countries[$countryCode] : $this->language->get('text_all_countries'),
				'region'	=> $regionName,
			);
		}

		$columns[] = "`origins` = '" . $this->db->escape(json_encode($origins)) . "'";
        $columns[] = "`from` = '" .  $this->db->escape($this->setFromFormat($data['condition'], $data['from'])) . "'";
        $columns[] = "`to` = '" . $this->db->escape(($data['code'] == 404) ? '' : $data['to']) . "'";

        if (isset($data['code']))
            $columns[] = "`code` = '" . (int)$data['code'] . "'";

        if (isset($data['status']))
            $columns[] = "`status` = '" . (int)(bool)$data['status'] . "'";

        $this->db->query("INSERT INTO `" . DB_PREFIX . "ip2location_redirector` SET " . implode(", ", $columns));

        return $this->db->getLastId();
    }

    /**
     * @param int $ruleId
     * @param array $data
     * @return int
     */
    public function editRule($ruleId, $data) {
		$columns = array();
		$countries = array();
		$origins = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ip2location_country");

		foreach ($query->rows as $result)
			$countries[$result['country_code']] = $result['country_name'];

		$wildcard = false;

		foreach ($data['origins'] as $origin) {
			if ($origin == '*-*') {
				$wildcard = true;
				break;
			}

			list($countryCode, $regionName) = explode('-', $origin);

			$origins[] = array(
				'code'		=> $countryCode,
				'name'		=> $countries[$countryCode],
				'region'	=> $regionName,
			);
		}

		if ($wildcard)
			$origins = array(
					array(
					'code'		=> '*',
					'name'		=> $this->language->get('text_all_countries'),
					'region'	=> '*',
				)
			);

		$columns[] = "`origins` = '" . $this->db->escape(json_encode($origins)) . "'";
        $columns[] = "`from` = '" .  $this->db->escape($this->setFromFormat($data['condition'], $data['from'])) . "'";
        $columns[] = "`to` = '" . $this->db->escape(($data['code'] == 404) ? '' : $data['to']) . "'";

        if (isset($data['code']))
            $columns[] = "`code` = '" . (int)$data['code'] . "'";

        if (isset($data['status']))
            $columns[] = "`status` = '" . (int)(bool)$data['status'] . "'";

        $this->db->query("UPDATE `" . DB_PREFIX . "ip2location_redirector` SET " . implode(", ", $columns) . " WHERE `rule_id` = '" . (int)$ruleId . "'");

        return $ruleId;
    }

    /**
     * @param int $ruleId
     * @return boolean
     */
    public function deleteRule($ruleId) {
        return $this->db->query("DELETE FROM `" . DB_PREFIX . "ip2location_redirector` WHERE `rule_id` = '" . (int)$ruleId . "'");
    }

    /**
     * @param array $data
     * @param bool $total
     * @return string
     */
    protected function getRulesSql($data = array(), $total = false) {
        $sql = array();

        $sql[] = "SELECT";
        $sql[] = $total ? " COUNT(*) as `total`" : " *";
        $sql[] = " FROM `" . DB_PREFIX . "ip2location_redirector`";

        $sql[] = " WHERE 1";

        if ($search = $this->getSearch($data))
            $sql[] = " AND (`origins` COLLATE UTF8_GENERAL_CI LIKE '%\"name\":\"" . $this->db->escape($search) . "%' OR `origins` COLLATE UTF8_GENERAL_CI LIKE '%\"region\":\"" . $this->db->escape($search) . "%' OR `from` LIKE '%" . $this->db->escape($search) . "%' OR `to` LIKE '%" . $this->db->escape($search) . "%')";

        if (isset($data['filter_status']) && is_bool($data['filter_status']))
            $sql[] = " AND `status` = '" . (int)$data['filter_status'] . "'";

        if (isset($data['filter_codes']) && $data['filter_codes'])
            $sql[] = " AND `code` IN (" . implode(", ", array_map(function ($code) {
                    return "'" . (int)$code . "'";
                }, $data['filter_codes'])) . ")";

        if ($sort = $this->getSort($data))
            $sql[] = " ORDER BY " . $sort . " " . $this->getOrder($data);

        if (!$total && ($this->hasOffset($data) || $this->hasLimit($data)))
            $sql[] = " LIMIT " . $this->getOffset($data) . ", " . $this->getLimit($data);

        return implode("", $sql);
    }

    /**
     * @param array $data
     * @return string
     */
    protected function getSearch($data = array()) {
        if (isset($data['filter_search']) && $data['filter_search']) {
            return (string)$data['filter_search'];
        }

        return '';
    }

    /**
     * @param array $data
     * @return bool
     */
    protected function hasOffset($data = array()) {
        return isset($data['offset']);
    }

    /**
     * @param array $data
     * @return bool
     */
    protected function hasLimit($data = array()) {
        return isset($data['limit']);
    }

	/**
     * @param string $condition
	 * @param string $from
     * @return string
     */
	protected function setFromFormat($condition, $from) {
		return (($condition == 0) ? '=' : (($condition == 1) ? '^' : '*')) . ltrim($from, '/');
	}

	/**
	 * @param string $from
     * @return array
     */
	protected function getFrom($from) {
		return array(
			'condition'	=> (substr($from, 0, 1) == '=') ? 0 : ((substr($from, 0, 1) == '^') ? 1 : 2),
			'from'		=> substr($from, 1),
		);
	}

    /**
     * @param array $data
     * @return int
     */
    protected function getOffset($data = array()) {
        if (isset($data['offset']) && (int)$data['offset'] >= 0)
            return (int)$data['offset'];

        return 0;
    }

    /**
     * @param array $data
     * @return int
     */
    protected function getLimit($data = array()) {
        if (isset($data['limit']) && (int)$data['limit'] > 0)
            return (int)$data['limit'];

        return 20;
    }

    /**
     * @param array $data
     * @param array $fields
     * @return string
     */
    protected function getSort($data = array(), $fields = array()) {
        if (isset($data['sort']) && $data['sort'] && (empty($fields) || in_array($data['sort'], $fields)))
            return $this->quoteColumnName($this->db->escape($data['sort']));

        return '';
    }

    protected function getOrder($data = array()) {
        return isset($data['order']) && strtoupper($data['order']) === 'DESC' ? 'DESC' : 'ASC';
    }

    /**
     * Returns quoted column name
     *
     * @param string $column
     * @return string
     */
    protected function quoteColumnName($column) {
        return implode('.', array_map(function ($part) {
            return '`' . $part . '`';
        }, explode('.', $column)));
    }
}
