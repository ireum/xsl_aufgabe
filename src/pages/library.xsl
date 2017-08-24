<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:key name="Book-by-Author" match="book" use="author"/>
    <xsl:param name="sortColumnField" select="//catalog/@sortby"/>
    <xsl:param name="sortColumnDataType" select="//catalog/@sortdatatype"/>
    <xsl:template match="/">

        <xsl:variable name="max">
            <xsl:for-each select="//catalog/book/price">
                <xsl:sort select="." data-type="number" order="descending"/>
                <xsl:if test="position() = 1">
                    <xsl:value-of select="."/>
                </xsl:if>
            </xsl:for-each>
        </xsl:variable>
        <xsl:variable name="min">
            <xsl:for-each select="//catalog/book/price">
                <xsl:sort select="." data-type="number" order="descending"/>
                <xsl:if test="position() =last()">
                    <xsl:value-of select="."/>
                </xsl:if>
            </xsl:for-each>
        </xsl:variable>

        <html>
            <head>
                <title>Library</title>
                <link rel="stylesheet" href="/css/lib.css"/>
            </head>
            <body>
                <header>
                    <a href="/library">
                        <h1>Library</h1>
                    </a>
                    <a class="add_book" href="/add">Add Book</a>
                </header>
                <form name="searchForm" action="/library" method="get">
                    <select name="author">
                        <option value="">All</option>
                        <xsl:for-each select="//catalog/book[not(author=preceding-sibling::book/author)]">
                            <option value="{author}">
                                <xsl:if test="author = //catalog/@author">
                                    <xsl:attribute name="selected">selected</xsl:attribute>
                                </xsl:if>
                                <xsl:copy-of select="author"/>
                            </option>
                        </xsl:for-each>
                    </select>
                    <input name="title" type="text" placeholder="Title" value="{//catalog/@title}"/>
                    <input name="minPrice"
                           type="number"
                           step="0.05"
                           value="{//catalog/@minprice}"
                           min="{$min}"
                           max="{$max}"/>
                    <input name='maxPrice'
                           type="number"
                           step="0.05"
                           value="{//catalog/@maxprice}"
                           min="{$min}"
                           max="{$max}"/>
                    <select name="sort">
                        <xsl:for-each select="//catalog/book[1]/*">
                            <option value="{name()}">
                                <xsl:if test="name() = //catalog/@sortby">
                                    <xsl:attribute name="selected">selected</xsl:attribute>
                                </xsl:if>
                                <xsl:value-of select="name()"/>
                            </option>
                        </xsl:for-each>
                    </select>
                    <input class="submit_button" name="submit" type="submit" value="Search"/>
                </form>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 10%;">Author</th>
                            <th style="width: 20%;">Title</th>
                            <th style="width: 10%;">Genre</th>
                            <th style="width: 5%;">Price</th>
                            <th style="width: 10%;">Release Date</th>
                            <th style="width: 40%;">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each select="catalog/book">
                            <xsl:sort select="*[name()=$sortColumnField]" data-type="{$sortColumnDataType}"
                                      order="ascending"/>
                            <xsl:if test="(
                        contains(title, //catalog/@title) and
                        contains(author, //catalog/@author) and
                        price >= //catalog/@minprice and price &lt;= //catalog/@maxprice
                        )">
                                <tr>
                                    <td style="width: 5%;">
                                        <xsl:value-of select="@id"/>
                                    </td>
                                    <td style="width: 10%;">
                                        <xsl:value-of select="author"/>
                                    </td>
                                    <td style="width: 20%;">
                                        <xsl:value-of select="title"/>
                                    </td>
                                    <td style="width: 10%;">
                                        <xsl:value-of select="genre"/>
                                    </td>
                                    <td style="width: 5%;">
                                        <xsl:value-of select="price"/>
                                    </td>
                                    <td style="width: 10%;">
                                        <xsl:value-of select="publish_date"/>
                                    </td>
                                    <td style="width: 40%;">
                                        <xsl:value-of select="description"/>
                                    </td>
                                </tr>
                            </xsl:if>
                        </xsl:for-each>
                    </tbody>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
