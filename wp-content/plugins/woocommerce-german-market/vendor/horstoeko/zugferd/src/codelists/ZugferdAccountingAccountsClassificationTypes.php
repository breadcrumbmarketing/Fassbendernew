<?php

/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\codelists;

/**
 * Class representing Accounting Account classifications
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class ZugferdAccountingAccountsClassificationTypes
{
    /**
     * The code indicates a general chart of accounts
     */
    const GENERAL_ACCOUNT_CHART_OF_ACCOUNTS = '1';

    /**
     * The code indicates a cost chart of accounts
     */
    const COST_ACCOUNTING_CHART_OF_ACCOUNTS = '2';

    /**
     * The code indicates a budget chart of accounts
     */
    const BUDGETARY_ACCOUNT_CHART_OF_ACCOUNTS = '3';

    /**
     * The code indicates a payable chart of accounts
     */
    const PAYABLE_ACCOUNT_CHART_OF_ACCOUNTS = '4';

    /**
     * The code indicates a receivable chart of accounts
     */
    const RECEIVABLE_ACCOUNT_CHART_OF_ACCOUNTS = '5';

    /**
     * The code indicates a job chart of accounts
     */
    const JOB_ACCOUNT_CHART_OF_ACCOUNTS = '6';

    /**
     * The code indicates a building site chart of accounts
     */
    const BUILDING_SITE_ACCOUNT_CHART_OF_ACCOUNTS = '7';
}
